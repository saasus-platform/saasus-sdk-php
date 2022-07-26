<?php

namespace AntiPatternInc\Saasus\Api;

use AntiPatternInc\Saasus\Sdk\Auth;
use AntiPatternInc\Saasus\Sdk\Billing;
use AntiPatternInc\Saasus\Sdk\Pricing;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use Http\Client\Common\PluginClient;

class Client
{
    protected Auth\Client $authClient;
    protected Billing\Client $billingClient;
    protected Pricing\Client $pricingClient;

    protected GuzzleClient $guzzleClient;

    protected string $token;
    protected string $secret;
    protected string $saasid;
    protected string $apikey;
    protected string $apibase;

    function __construct()
    {
        $this->secret = getenv('SAASUS_SECRET_KEY');
        $this->saasid = getenv('SAASUS_SAAS_ID');
        $this->apikey = getenv('SAASUS_API_KEY');
        if ($this->secret == "" || $this->saasid == "" || $this->apikey == "") {
            error_log('SAASUS_SECRET_KEY, SAASUS_SAAS_ID and SAASUS_API_KEY are required.');
            return false;
        }

        $this->apibase = getenv('SAASUS_API_URL_BASE');
        if ($this->apibase == "") {
            $this->apibase = "https://api.saasus.io";
        }

        $handlers = HandlerStack::create();
        $handlers->push(new GuzzleMiddleware(
            $this->secret,
            $this->saasid,
            $this->apikey,
        ));

        $this->guzzleClient = new GuzzleClient(
            [
                'headers' => [
                    'content-type' => 'application/json',
                ],
                'handler' => $handlers,
            ]
        );

        $this->authClient = Auth\Client::create($this->createApiClient($this->apibase . "/v0/auth"));
        $this->billingClient = Billing\Client::create($this->createApiClient($this->apibase . "/v0/billing"));
        $this->pricingClient = Pricing\Client::create($this->createApiClient($this->apibase . "/v0/pricing"));
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
}
