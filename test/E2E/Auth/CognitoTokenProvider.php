<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

final class CognitoTokenProvider
{
    private string $userPoolId;
    private string $clientId;
    private string $region;
    private string $endpoint;
    private string $accessKey;
    private string $secretKey;
    private string $sessionToken;
    private Client $http;

    private function __construct()
    {
        $this->userPoolId = self::env('E2E_COGNITO_USER_POOL_ID');
        $this->clientId = self::env('E2E_COGNITO_CLIENT_ID');
        $this->region = self::env('E2E_COGNITO_REGION', 'ap-northeast-1');
        $this->endpoint = rtrim(
            self::env('E2E_COGNITO_ENDPOINT', 'https://cognito-idp.' . $this->region . '.amazonaws.com'),
            '/'
        );
        $this->accessKey = self::env('AWS_ACCESS_KEY_ID');
        $this->secretKey = self::env('AWS_SECRET_ACCESS_KEY');
        $this->sessionToken = self::env('AWS_SESSION_TOKEN');
        $this->http = new Client(['timeout' => 30, 'connect_timeout' => 10]);
    }

    public static function fromEnvironment(): self
    {
        $provider = new self();
        $missing = [];
        foreach ([
            'E2E_COGNITO_USER_POOL_ID' => $provider->userPoolId,
            'E2E_COGNITO_CLIENT_ID' => $provider->clientId,
            'AWS_ACCESS_KEY_ID' => $provider->accessKey,
            'AWS_SECRET_ACCESS_KEY' => $provider->secretKey,
        ] as $name => $value) {
            if ($value === '') {
                $missing[] = $name;
            }
        }
        if ($missing !== []) {
            throw new RuntimeException('Missing Cognito E2E environment variables: ' . implode(', ', $missing));
        }
        return $provider;
    }

    public static function isConfigured(): bool
    {
        foreach ([
            'E2E_COGNITO_USER_POOL_ID',
            'E2E_COGNITO_CLIENT_ID',
            'AWS_ACCESS_KEY_ID',
            'AWS_SECRET_ACCESS_KEY',
        ] as $name) {
            if (self::env($name) === '') {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array{access_token: string, id_token: string, refresh_token: string}
     */
    public function configuredUserTokens(): array
    {
        $username = self::env('E2E_COGNITO_USERNAME');
        $password = self::env('E2E_COGNITO_PASSWORD');
        if ($username === '' || $password === '') {
            throw new RuntimeException('E2E_COGNITO_USERNAME and E2E_COGNITO_PASSWORD are required.');
        }
        return $this->authenticate($username, $password);
    }

    /**
     * @return array{access_token: string, id_token: string, refresh_token: string}
     */
    public function ensureUserTokens(string $email, string $password): array
    {
        try {
            return $this->authenticate($email, $password);
        } catch (RuntimeException $error) {
            if (strpos($error->getMessage(), 'NotAuthorizedException') === false
                && strpos($error->getMessage(), 'UserNotFoundException') === false
            ) {
                throw $error;
            }
        }

        $username = $this->findUsernameByEmail($email);
        if ($username === '') {
            $username = 'e2e-' . sha1(strtolower($email));
            try {
                $this->request('AdminCreateUser', [
                    'UserPoolId' => $this->userPoolId,
                    'Username' => $username,
                    'UserAttributes' => [
                        ['Name' => 'email', 'Value' => $email],
                        ['Name' => 'email_verified', 'Value' => 'true'],
                    ],
                    'MessageAction' => 'SUPPRESS',
                ]);
            } catch (RuntimeException $error) {
                if (strpos($error->getMessage(), 'UsernameExistsException') === false
                    && strpos($error->getMessage(), 'AliasExistsException') === false
                ) {
                    throw $error;
                }
            }
        }

        $this->request('AdminSetUserPassword', [
            'UserPoolId' => $this->userPoolId,
            'Username' => $username,
            'Password' => $password,
            'Permanent' => true,
        ]);
        return $this->authenticate($email, $password);
    }

    /** @return array{secret: string, session: string} */
    public function associateSoftwareToken(string $accessToken): array
    {
        $result = $this->request('AssociateSoftwareToken', ['AccessToken' => $accessToken]);
        $secret = isset($result['SecretCode']) ? (string) $result['SecretCode'] : '';
        if ($secret === '') {
            throw new RuntimeException('AssociateSoftwareToken returned no SecretCode.');
        }
        return [
            'secret' => $secret,
            'session' => isset($result['Session']) ? (string) $result['Session'] : '',
        ];
    }

    public static function currentTotp(string $base32Secret): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $bits = '';
        foreach (str_split(strtoupper(rtrim($base32Secret, '='))) as $character) {
            $position = strpos($alphabet, $character);
            if ($position === false) {
                throw new RuntimeException('Invalid base32 TOTP secret.');
            }
            $bits .= str_pad(decbin($position), 5, '0', STR_PAD_LEFT);
        }
        $secret = '';
        for ($offset = 0; $offset + 8 <= strlen($bits); $offset += 8) {
            $secret .= chr(bindec(substr($bits, $offset, 8)));
        }

        $counter = intdiv(time(), 30);
        $counterBytes = pack('N2', ($counter >> 32) & 0xffffffff, $counter & 0xffffffff);
        $hash = hash_hmac('sha1', $counterBytes, $secret, true);
        $offset = ord(substr($hash, -1)) & 0x0f;
        $binary = unpack('N', substr($hash, $offset, 4))[1] & 0x7fffffff;
        return str_pad((string) ($binary % 1000000), 6, '0', STR_PAD_LEFT);
    }

    /**
     * @return array{access_token: string, id_token: string, refresh_token: string}
     */
    private function authenticate(string $username, string $password): array
    {
        $result = $this->request('AdminInitiateAuth', [
            'AuthFlow' => 'ADMIN_USER_PASSWORD_AUTH',
            'AuthParameters' => ['USERNAME' => $username, 'PASSWORD' => $password],
            'ClientId' => $this->clientId,
            'UserPoolId' => $this->userPoolId,
        ]);

        if (($result['ChallengeName'] ?? '') === 'NEW_PASSWORD_REQUIRED') {
            $result = $this->request('RespondToAuthChallenge', [
                'ChallengeName' => 'NEW_PASSWORD_REQUIRED',
                'ClientId' => $this->clientId,
                'ChallengeResponses' => ['USERNAME' => $username, 'NEW_PASSWORD' => $password],
                'Session' => $result['Session'] ?? '',
            ]);
        }

        $authentication = $result['AuthenticationResult'] ?? null;
        if (!is_array($authentication)) {
            throw new RuntimeException('Cognito AuthenticationResult is empty.');
        }
        return [
            'access_token' => (string) ($authentication['AccessToken'] ?? ''),
            'id_token' => (string) ($authentication['IdToken'] ?? ''),
            'refresh_token' => (string) ($authentication['RefreshToken'] ?? ''),
        ];
    }

    private function findUsernameByEmail(string $email): string
    {
        $result = $this->request('ListUsers', [
            'UserPoolId' => $this->userPoolId,
            'Filter' => 'email = "' . str_replace('"', '\\"', $email) . '"',
            'Limit' => 1,
        ]);
        return isset($result['Users'][0]['Username']) ? (string) $result['Users'][0]['Username'] : '';
    }

    /** @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    private function request(string $operation, array $payload): array
    {
        $body = (string) json_encode($payload, JSON_UNESCAPED_SLASHES);
        $url = $this->endpoint . '/';
        $host = (string) parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $scheme = (string) parse_url($url, PHP_URL_SCHEME);
        if (is_int($port)
            && !(strcasecmp($scheme, 'http') === 0 && $port === 80)
            && !(strcasecmp($scheme, 'https') === 0 && $port === 443)
        ) {
            $host .= ':' . $port;
        }
        $now = gmdate('Ymd\THis\Z');
        $date = substr($now, 0, 8);
        $target = 'AWSCognitoIdentityProviderService.' . $operation;
        $headers = [
            'content-type' => 'application/x-amz-json-1.1',
            'host' => $host,
            'x-amz-date' => $now,
            'x-amz-target' => $target,
        ];
        if ($this->sessionToken !== '') {
            $headers['x-amz-security-token'] = $this->sessionToken;
        }
        ksort($headers);
        $canonicalHeaders = '';
        foreach ($headers as $name => $value) {
            $canonicalHeaders .= $name . ':' . trim($value) . "\n";
        }
        $signedHeaders = implode(';', array_keys($headers));
        $canonicalRequest = implode("\n", [
            'POST',
            '/',
            '',
            $canonicalHeaders,
            $signedHeaders,
            hash('sha256', $body),
        ]);
        $scope = $date . '/' . $this->region . '/cognito-idp/aws4_request';
        $stringToSign = "AWS4-HMAC-SHA256\n" . $now . "\n" . $scope . "\n" . hash('sha256', $canonicalRequest);
        $dateKey = hash_hmac('sha256', $date, 'AWS4' . $this->secretKey, true);
        $regionKey = hash_hmac('sha256', $this->region, $dateKey, true);
        $serviceKey = hash_hmac('sha256', 'cognito-idp', $regionKey, true);
        $signingKey = hash_hmac('sha256', 'aws4_request', $serviceKey, true);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);
        $headers['authorization'] = 'AWS4-HMAC-SHA256 Credential=' . $this->accessKey . '/' . $scope
            . ', SignedHeaders=' . $signedHeaders . ', Signature=' . $signature;

        try {
            $response = $this->http->post($url, ['headers' => $headers, 'body' => $body]);
        } catch (GuzzleException $error) {
            $message = $error->getMessage();
            if (method_exists($error, 'getResponse') && $error->getResponse() !== null) {
                $message .= ': ' . (string) $error->getResponse()->getBody();
            }
            throw new RuntimeException('Cognito ' . $operation . ' failed: ' . $message, 0, $error);
        }
        $decoded = json_decode((string) $response->getBody(), true);
        return is_array($decoded) ? $decoded : [];
    }

    private static function env(string $name, string $default = ''): string
    {
        $value = getenv($name);
        return $value === false || $value === '' ? $default : $value;
    }
}
