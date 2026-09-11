# Common E2E test library

This directory contains the reusable test foundation for every SaaSus PHP SDK
module. It mirrors the story-based test structure under
`saasus-sdk-go/tests/testlib`.

## Example

```php
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;

$engine = new E2EEngine($client, ['getStripeInfo']);
$stories = [
    new Story(
        name: 'Billing API',
        steps: [
            new Step(
                name: 'Get Stripe information',
                clientMethod: 'getStripeInfo',
                // Jane clients expose the raw PSR-7 response with this argument.
                parameters: ['fetch' => $client::FETCH_RESPONSE],
                expectedStatus: 200
            ),
        ]
    ),
];

$results = $engine->executeStories($stories);
$engine->printResults($results);
```

Step parameters can be a positional array, an array keyed by the generated
client method's parameter names, or a callback that receives the current story
variables. Validation callbacks throw on failure. State update callbacks may
receive the variables array by reference:

```php
stateUpdate: function ($response, array &$variables): void {
    $variables['resource_id'] = (string) $response->getHeaderLine('X-Resource-Id');
}
```

Required environment variables are `SAASUS_SAAS_ID`, `SAASUS_API_KEY`, and
`SAASUS_SECRET_KEY`. `Config` searches for `.env` from the current directory up
to four parent directories. Optional settings are `SAASUS_API_URL_BASE` (or
`SAASUS_BASE_URL`), `LOG_LEVEL`, `E2E_LOG_LEVEL`, `E2E_DRY_RUN`,
`E2E_TIMEOUT`, and `E2E_MAX_RETRIES`.
