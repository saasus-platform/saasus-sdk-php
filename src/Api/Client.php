<?php

namespace AntiPatternInc\Saasus\Api;

use AntiPatternInc\Saasus\Sdk\Auth;
use AntiPatternInc\Saasus\Sdk\Billing;
use AntiPatternInc\Saasus\Sdk\Pricing;
use AntiPatternInc\Saasus\Sdk\Integration;
use AntiPatternInc\Saasus\Sdk\AwsMarketplace;
use AntiPatternInc\Saasus\Sdk\Communication;
use AntiPatternInc\Saasus\Sdk\ApiLog;
use Exception;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use Http\Client\Common\PluginClient;

class Client
{
    protected Auth\Client $authClient;
    protected Billing\Client $billingClient;
    protected Pricing\Client $pricingClient;
    protected Integration\Client $integrationClient;
    protected AwsMarketplace\Client $awsMarketplaceClient;
    protected Communication\Client $communicationClient;
    protected ApiLog\Client $apiLogClient;

    protected GuzzleClient $guzzleClient;

    protected string $token;
    protected string $secret;
    protected string $saasid;
    protected string $apikey;
    protected string $apibase;
    protected string $referer;

    function __construct($referer = "")
    {
        $this->secret = getenv('SAASUS_SECRET_KEY');
        $this->saasid = getenv('SAASUS_SAAS_ID');
        $this->apikey = getenv('SAASUS_API_KEY');

        $errors = [];
        if (empty($this->secret))
            $errors[] = 'SAASUS_SECRET_KEY';
        if (empty($this->saasid))
            $errors[] = 'SAASUS_SAAS_ID';
        if (empty($this->apikey))
            $errors[] = 'SAASUS_API_KEY';

        if (count($errors) > 0)
            throw new Exception(implode(",", $errors) . " are required. Please, refer to https://github.com/saasus-platform/saasus-sdk-php/blob/main/README.md and add it to your .env file");

        $this->apibase = getenv('SAASUS_API_URL_BASE');
        if ($this->apibase == "") {
            $this->apibase = "https://api.saasus.io";
        }

        $this->referer = $referer;

        $handlers = HandlerStack::create();
        $handlers->push(new GuzzleMiddleware(
            $this->secret,
            $this->saasid,
            $this->apikey,
            $this->referer
        ));

        $this->guzzleClient = new GuzzleClient(
            [
                'headers' => [
                    'content-type' => 'application/json',
                ],
                'handler' => $handlers,
            ]
        );

        $this->authClient = Auth\Client::create($this->createApiClient($this->apibase . "/v1/auth"));
        $this->billingClient = Billing\Client::create($this->createApiClient($this->apibase . "/v1/billing"));
        $this->pricingClient = Pricing\Client::create($this->createApiClient($this->apibase . "/v1/pricing"));
        $this->integrationClient = Integration\Client::create($this->createApiClient($this->apibase . "/v1/integration"));
        $this->awsMarketplaceClient = AwsMarketplace\Client::create($this->createApiClient($this->apibase . "/v1/awsmarketplace"));
        $this->communicationClient = Communication\Client::create($this->createApiClient($this->apibase . "/v1/communication"));
        $this->apiLogClient = ApiLog\Client::create($this->createApiClient($this->apibase . "/v1/apilog"));
    }

    protected function createApiClient($apibase)
    {
        $plugins = array();
        $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri($apibase);
        $httpClient = new GuzzleAdapter($this->guzzleClient);
        $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
        $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
        return new PluginClient($httpClient, $plugins);
    }

    public function getAuthClient()
    {
        return $this->authClient;
    }

    public function getBllingClient()
    {
        return $this->billingClient;
    }

    public function getPricingClient()
    {
        return $this->pricingClient;
    }

    public function getIntegrationClient()
    {
        return $this->integrationClient;
    }

    public function getAwsMarketplaceClient()
    {
        return $this->awsMarketplaceClient;
    }

    public function getCommunicationClient()
    {
        return $this->communicationClient;
    }

    public function getApiLogClient()
    {
        return $this->apiLogClient;
    }
}
