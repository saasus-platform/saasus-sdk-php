<?php

namespace AntiPatternInc\Saasus\Api;

class GuzzleMiddleware
{
    private $next;

    protected string $secret;
    protected string $saasid;
    protected string $apikey;
    protected string $referer;
    protected string $xSaasusReferer;

    function __construct($secret = "", $saasid = "", $apikey = "", $referer = "", $xSaasusReferer = "")
    {
        $this->secret = $secret;
        $this->saasid = $saasid;
        $this->apikey = $apikey;
        $this->referer = $referer;
        $this->xSaasusReferer = $xSaasusReferer;
    }

    public function __invoke(callable $next)
    {
        $this->next = $next;
        return [$this, 'execute'];
    }

    public function execute(\Psr\Http\Message\RequestInterface $req, array $options)
    {
        $header = GuzzleMiddleware::getSignAsHeader(
            $this->secret,
            $this->apikey,
            $this->saasid,
            $req->getMethod(),
            $req->getHeaders()["Host"][0],
            $req->getUri()->getPath(),
            $req->getUri()->getQuery(),
            $req->getBody()
        );
        $req = $req->withHeader('Authorization', $header);
        if (!empty($this->referer)) {
            $req = $req->withHeader('Referer', $this->referer);
        }
        if (!empty($this->xSaasusReferer)) {
            $req = $req->withHeader('X-SaaSus-Referer', $this->xSaasusReferer);
        }

        return call_user_func($this->next, $req, $options);
    }

    public static function getSignAsHeader(
        string $secret,
        string $apikey,
        string $saasid,
        string $method,
        string $host,
        string $path,
        string $query,
        string $body
    ): string {

        if (empty($secret) || empty($apikey) || empty($saasid)) {
            return "";
        }

        $literal = "SAASUSSIGV1";

        $now = gmdate('YmdHi');
        $data = $now . $apikey . strtoupper($method) . $host . $path;
        if (!empty($query)) {
            $data = $data . "?" . $query;
        }
        $data = $data . $body;

        $sign = hash_hmac('sha256', $data, $secret);

        $header = sprintf(
            "%s Sig=%s, SaaSID=%s, APIKey=%s",
            $literal,
            $sign,
            $saasid,
            $apikey
        );
        return $header;
    }
}
