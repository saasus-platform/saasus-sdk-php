<?php

namespace AntiPatternInc\Saasus\Test\Contract;

use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderSetPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Round-trips the generated jane clients against a Prism mock started from the
 * latest OpenAPI spec: it checks that the requests the SDK builds are accepted
 * by the mock and that the responses deserialize into the SDK's models.
 *
 * Operations are enumerated from the spec at run time, so an SDK that lacks an
 * operation simply has no case for it — which makes the same suite usable for a
 * previously released SDK (forward compatibility, step C). This file is the
 * stable entry point: its class name and location must not change across SDK
 * generations, because every release runs the suite it bundles.
 *
 * Only the default FETCH_OBJECT call form is exercised. jane generates a single
 * client method per operation; its only variation is the trailing $fetch mode,
 * and FETCH_OBJECT is the one that actually deserializes the response into the
 * SDK models (FETCH_RESPONSE returns the raw PSR-7 response without
 * deserialization, so it adds nothing for this check).
 *
 * Synthetic data only: a constant bearer token and request values taken from
 * the spec; no response body, token or PII is logged.
 */
class ContractTest extends TestCase
{
    /** All SDK modules: spec/env key (lower-case) => generated namespace segment. */
    private const MODULES = [
        'auth' => 'Auth',
        'pricing' => 'Pricing',
        'billing' => 'Billing',
        'awsmarketplace' => 'AwsMarketplace',
        'integration' => 'Integration',
        'apilog' => 'ApiLog',
        'communication' => 'Communication',
    ];

    /**
     * The spec declares a bearer scheme and Prism (--errors) rejects requests
     * without credentials, but it does not validate the value.
     */
    private const BEARER = 'synthetic-bearer-token';

    /** @var array<string,object> one client per module, reused across its cases */
    private static array $clients = [];

    /** @var array<string,StatusCapturingPlugin> one status probe per module's client */
    private static array $statusProbes = [];

    /**
     * One case per operation (and per request-body variant) of every module
     * that has both a spec file (CONTRACT_SPEC_DIR) and a mock
     * (PRISM_URL_<MODULE>). An operation the SDK does not implement is skipped
     * here, so an older SDK naturally runs a subset.
     *
     * @return array<string,array{0:?string,1:?string,2:int,3:?string}>
     */
    public static function contractCases(): array
    {
        $specDir = getenv('CONTRACT_SPEC_DIR');
        $cases = [];
        if ($specDir !== false && $specDir !== '') {
            foreach (self::MODULES as $module => $segment) {
                if (self::prismUrl($module) === null) {
                    continue;
                }
                $spec = Spec::load($specDir, $module);
                if ($spec === null) {
                    continue;
                }
                $clientClass = self::clientClass($segment);
                foreach ($spec->operations() as $op) {
                    if (!method_exists($clientClass, Spec::methodName($op->operationId))) {
                        continue;
                    }
                    $labels = $spec->bodyVariants($op);
                    if ($labels === []) {
                        $cases[$module . '.' . $op->operationId] = [$module, $op->operationId, 0, null];
                        continue;
                    }
                    foreach ($labels as $i => $label) {
                        $cases[$module . '.' . $op->operationId . '(' . $label . ')'] = [$module, $op->operationId, $i, $label];
                    }
                }
            }
        }
        if ($cases === []) {
            // Keep PHPUnit from reporting an empty data set when the suite is run
            // with no module configured (e.g. a bare local run); the test skips.
            $cases['(no module configured)'] = [null, null, 0, null];
        }
        return $cases;
    }

    /**
     * @dataProvider contractCases
     */
    public function testContract(?string $module, ?string $operationId, int $variantIndex, ?string $label): void
    {
        if ($module === null || $operationId === null) {
            $this->markTestSkipped('no module configured: set CONTRACT_SPEC_DIR and PRISM_URL_<MODULE>');
        }
        $base = self::prismUrl($module);
        $specDir = getenv('CONTRACT_SPEC_DIR');
        if ($base === null || $specDir === false || $specDir === '') {
            $this->markTestSkipped('mock or spec not configured for ' . $module);
        }

        $spec = Spec::load($specDir, $module);
        $this->assertNotNull($spec, "cannot load spec for {$module}");
        $op = $spec->operation($operationId);
        $this->assertNotNull($op, "{$operationId} not found in spec");

        $client = $this->client($module, $base);
        $method = new \ReflectionMethod($client, Spec::methodName($operationId));
        [$args, $arrayArgIndexes] = $this->buildArgs($method, $spec, $op, $variantIndex, $module);

        $id = $this->caseId($module, $operationId, $label);
        $probe = self::$statusProbes[$module] ?? null;
        if ($probe !== null) {
            // Clear any status left by a previous case so a thrown call cannot be
            // judged against a stale value.
            $probe->status = null;
        }
        try {
            $result = $this->invokeTolerant($method, $client, $args, $arrayArgIndexes, $op);
        } catch (\Throwable $e) {
            $status = $this->statusOf($e);
            // An operation that declares no 2xx response is expected to surface
            // the error it does declare; that is the check for it.
            if (!$op->hasSuccess && $status !== 0 && isset($op->statuses[$status])) {
                $this->assertTrue(true);
                return;
            }
            // Otherwise the round trip failed. A 4xx means the mock, validating
            // against the same spec the request was built from, rejected it; a
            // 5xx means Prism could not produce the declared response; a
            // deserialization error means the response did not fit the SDK type.
            // The original exception is neither chained nor quoted so that no
            // response body reaches the logs — re-run locally for the detail.
            $this->fail(sprintf(
                '%s failed: %s%s — response bodies are deliberately not reported; re-run locally for the detail',
                $id,
                get_class($e),
                $status !== 0 ? " (HTTP {$status})" : ''
            ));
        }

        // jane does not turn every HTTP error into an exception: a status its
        // generated endpoint does not explicitly handle returns null instead of
        // throwing (see StatusCapturingPlugin). Verify the recorded status so an
        // undeclared error on a bodyless operation is not mistaken for an empty 2xx.
        $status = $probe !== null ? ($probe->status ?? 0) : 0;
        if ($status !== 0 && ($status < 200 || $status >= 300)) {
            // Same classification as the exception path: an operation that
            // declares no 2xx may surface a status it declares; any other
            // non-2xx (and any non-2xx for a success operation) fails.
            if ($op->hasSuccess || !isset($op->statuses[$status])) {
                $this->fail("{$id} failed: unexpected HTTP status {$status}");
            }
            return;
        }

        // Whether a non-null payload is expected is decided from THIS SDK's own
        // generated method, not the latest spec: an older SDK generated before a
        // response body was added has no model for it and returns null, which is
        // a backward-compatible change it must tolerate.
        if ($this->sdkModelsSuccessBody($method)) {
            $this->assertNotNull($result, "{$id}: response was not deserialized into an SDK object");
        } else {
            // The SDK models no success body for this operation; null is correct.
            $this->assertTrue(true);
        }
    }

    /**
     * Whether the generated client method deserializes a success body, read from
     * its {@code @return} doc tag: jane writes `null|<Model>|ResponseInterface`
     * when it models a body and `null|ResponseInterface` when it does not. This
     * is the SDK's own shape, so an older SDK that predates a newly added body is
     * not expected to populate it.
     */
    private function sdkModelsSuccessBody(\ReflectionMethod $method): bool
    {
        $doc = $method->getDocComment();
        if ($doc === false) {
            return false;
        }
        if (!preg_match('/@return\s+([^\r\n]+)/', $doc, $matches)) {
            return false;
        }
        return strpos($matches[1], '\\Model\\') !== false;
    }

    /**
     * Every spec operation of a configured module must map to a generated SDK
     * method. Enforced only for the latest SDK (CONTRACT_REQUIRE_COMPLETE=true,
     * set in workflow step B); an older SDK legitimately lacks newer operations,
     * so there this is reported as skipped rather than silently passing.
     */
    public function testAllOperationsEnumerated(): void
    {
        if (strtolower((string) getenv('CONTRACT_REQUIRE_COMPLETE')) !== 'true') {
            $this->markTestSkipped('CONTRACT_REQUIRE_COMPLETE is not set: completeness is enforced only for the latest SDK');
        }
        $specDir = getenv('CONTRACT_SPEC_DIR');
        if ($specDir === false || $specDir === '') {
            $this->markTestSkipped('CONTRACT_SPEC_DIR is not set');
        }
        $missing = [];
        foreach (self::MODULES as $module => $segment) {
            if (self::prismUrl($module) === null) {
                continue;
            }
            $spec = Spec::load($specDir, $module);
            if ($spec === null) {
                continue;
            }
            $clientClass = self::clientClass($segment);
            foreach ($spec->operations() as $op) {
                if (!method_exists($clientClass, Spec::methodName($op->operationId))) {
                    $missing[] = $module . '.' . $op->operationId;
                }
            }
        }
        $this->assertSame([], $missing, 'spec operations not present in the SDK: ' . implode(', ', $missing));
    }

    // --- argument synthesis -------------------------------------------------

    /**
     * Fills the generated argument list by reflecting the method's parameters:
     * path parameters are scalar positional arguments bound by name, the query
     * and header parameters are gathered into the $queryParameters and
     * $headerParameters array arguments respectively, and the request body is
     * the one object argument. The trailing $fetch argument is left to its
     * default (FETCH_OBJECT).
     *
     * @return array{0:array<int,mixed>,1:int[]} the argument list and the indexes
     *                                           of the query/header array arguments
     */
    private function buildArgs(\ReflectionMethod $method, Spec $spec, Operation $op, int $variantIndex, string $module): array
    {
        $args = [];
        $arrayArgIndexes = [];
        foreach ($method->getParameters() as $param) {
            if ($param->getName() === 'fetch') {
                break;
            }
            $type = $param->getType();
            $typeName = $type instanceof \ReflectionNamedType ? $type->getName() : null;
            if ($typeName === 'array') {
                // jane names the gathered arguments after the properties they
                // fill: bind $headerParameters and $queryParameters by name.
                $arrayArgIndexes[] = count($args);
                $args[] = $param->getName() === 'headerParameters'
                    ? $spec->headerValues($op)
                    : $spec->queryValues($op);
            } elseif ($typeName === 'stdClass') {
                $args[] = $this->bodyStd($spec, $op, $variantIndex);
            } elseif ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                $args[] = $this->bodyModel($spec, $op, $variantIndex, $typeName, $module);
            } else {
                $args[] = $this->pathArg($spec, $op, $param->getName(), $typeName);
            }
        }
        return [$args, $arrayArgIndexes];
    }

    /**
     * Invokes the method and, if an older SDK rejects a query/header key the
     * latest spec added, resends after dropping only the unknown keys. Adding an
     * optional query or header parameter is backward compatible, so the older
     * SDK (which has no option for it) must still round-trip while every
     * parameter it does support is still sent.
     *
     * @param array<int,mixed> $args
     * @param int[] $arrayArgIndexes indexes of the query/header array arguments
     * @return mixed
     */
    private function invokeTolerant(\ReflectionMethod $method, object $client, array $args, array $arrayArgIndexes, Operation $op)
    {
        // One retry can clear the keys named by each resolver; bound the loop by
        // the number of parameters so a parser mismatch cannot spin forever.
        $budget = count($op->queryParams) + count($op->headerParams) + 1;
        for ($attempt = 0; ; $attempt++) {
            try {
                return $method->invokeArgs($client, $args);
            } catch (UndefinedOptionsException $e) {
                $unknown = self::undefinedOptionNames($e->getMessage());
                if ($arrayArgIndexes === [] || $unknown === [] || $attempt >= $budget) {
                    throw $e;
                }
                $removed = false;
                foreach ($arrayArgIndexes as $idx) {
                    foreach ($unknown as $key) {
                        if (is_array($args[$idx]) && array_key_exists($key, $args[$idx])) {
                            unset($args[$idx][$key]);
                            $removed = true;
                        }
                    }
                }
                if (!$removed) {
                    throw $e;
                }
            }
        }
    }

    /**
     * The option names an UndefinedOptionsException reports as not existing,
     * parsed from its message ("The option \"x\" does not exist." or "The
     * options \"x\", \"y\" do not exist."). Only these keys are dropped on a
     * forward-compat resend, so the parameters the SDK does support are kept.
     *
     * @return string[]
     */
    public static function undefinedOptionNames(string $message): array
    {
        if (!preg_match('/The option[s]?\s+(.+?)\s+(?:does|do) not exist/', $message, $m)) {
            return [];
        }
        preg_match_all('/"([^"]+)"/', $m[1], $names);
        return $names[1];
    }

    /** @return mixed a Model instance built from the spec, for a typed body argument */
    private function bodyModel(Spec $spec, Operation $op, int $variantIndex, string $class, string $module)
    {
        $data = $spec->bodyValue($op, $variantIndex);
        if (!is_array($data)) {
            $data = [];
        }
        return $this->serializer($module)->denormalize($data, $class);
    }

    /** @return mixed a stdClass built from the spec, for a stdClass body argument */
    private function bodyStd(Spec $spec, Operation $op, int $variantIndex)
    {
        return json_decode(json_encode($spec->bodyValue($op, $variantIndex)));
    }

    /** @return mixed a scalar bound to the path parameter whose jane argument name matches */
    private function pathArg(Spec $spec, Operation $op, string $paramName, ?string $typeName)
    {
        foreach ($op->pathParams as $pathParam) {
            if (Spec::argName($pathParam->name) === $paramName) {
                return $this->coerce($spec->paramValue($pathParam), $typeName);
            }
        }
        // Binding by position instead would send a valid-looking request built
        // from the wrong value, so fail loudly on an unbindable argument.
        throw new \RuntimeException(
            "{$op->operationId}: cannot bind argument \${$paramName} to a spec path parameter"
        );
    }

    /** @param mixed $value @return mixed */
    private function coerce($value, ?string $typeName)
    {
        switch ($typeName) {
            case 'int':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'bool':
                return (bool) $value;
            default:
                return (string) $value;
        }
    }

    // --- reflective SDK access ----------------------------------------------

    private function client(string $module, string $base): object
    {
        if (isset(self::$clients[$module])) {
            return self::$clients[$module];
        }
        $uri = Psr17FactoryDiscovery::findUriFactory()->createUri($base);
        // The base URL is the Prism mock root (no path): AddHostPlugin sets the
        // scheme/host/port and the endpoints already carry absolute paths, so no
        // AddPathPlugin is used (it rejects a path-less base URL anyway).
        $probe = new StatusCapturingPlugin();
        $plugins = [
            new AddHostPlugin($uri),
            $probe,
            // The hand-written authentication wrapper is deliberately bypassed:
            // this suite verifies the generated client against the spec.
            new HeaderSetPlugin(['Authorization' => 'Bearer ' . self::BEARER]),
        ];
        $httpClient = new PluginClient(Psr18ClientDiscovery::find(), $plugins);
        $clientClass = self::clientClass(self::MODULES[$module]);
        $client = $clientClass::create($httpClient);
        self::$clients[$module] = $client;
        self::$statusProbes[$module] = $probe;
        return $client;
    }

    /** A serializer wired like the generated client's, for building request bodies. */
    private function serializer(string $module): Serializer
    {
        $normalizerClass = 'AntiPatternInc\\Saasus\\Sdk\\' . self::MODULES[$module] . '\\Normalizer\\JaneObjectNormalizer';
        return new Serializer(
            [new ArrayDenormalizer(), new $normalizerClass()],
            [new JsonEncoder(new JsonEncode(), new JsonDecode(['json_decode_associative' => true]))]
        );
    }

    /** HTTP status carried by a generated jane exception, or 0. Only the number is read. */
    private function statusOf(\Throwable $e): int
    {
        if (method_exists($e, 'getResponse')) {
            $response = $e->getResponse();
            if ($response instanceof ResponseInterface) {
                return $response->getStatusCode();
            }
        }
        return 0;
    }

    private static function clientClass(string $segment): string
    {
        return 'AntiPatternInc\\Saasus\\Sdk\\' . $segment . '\\Client';
    }

    private static function prismUrl(string $module): ?string
    {
        $url = getenv('PRISM_URL_' . strtoupper($module));
        return $url !== false && $url !== '' ? $url : null;
    }

    private function caseId(string $module, string $operationId, ?string $label): string
    {
        return $module . '.' . $operationId . ($label === null ? '' : "({$label})");
    }
}
