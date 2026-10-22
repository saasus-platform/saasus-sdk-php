<?php

namespace AntiPatternInc\Saasus\Test\Contract;

use Symfony\Component\Yaml\Yaml;

/**
 * A parsed OpenAPI document: the source of every request input.
 *
 * Values come from the spec (its `example` and declared schema) rather than
 * being hardcoded, so they are acceptable by construction — the Prism mock
 * validates requests against the same document. The only language-specific part
 * lives in {@see ContractTest}: binding an operationId to a generated jane
 * method. Everything here (operationId -> path/query/body) is language-agnostic
 * and mirrors the Go/Java harnesses.
 */
final class Spec
{
    private const HTTP_METHODS = ['get', 'put', 'post', 'delete', 'patch', 'head', 'options'];

    /** Fallback for a string with neither an example nor a usable schema. */
    public const SYNTHETIC = 'synthetic';

    /** @var array<string,mixed> */
    private array $root;
    /** @var array<string,Operation> keyed by operationId */
    private array $ops = [];

    /** @param array<string,mixed> $root */
    private function __construct(array $root)
    {
        $this->root = $root;
        $this->index();
    }

    public static function load(string $dir, string $module): ?self
    {
        $file = rtrim($dir, '/') . '/' . $module . '.yml';
        if (!is_file($file)) {
            return null;
        }
        $data = Yaml::parseFile($file);
        if (!is_array($data)) {
            return null;
        }
        return new self($data);
    }

    /** @return Operation[] */
    public function operations(): array
    {
        $ops = array_values($this->ops);
        usort($ops, static fn (Operation $a, Operation $b) => strcmp($a->operationId, $b->operationId));
        return $ops;
    }

    public function operation(string $operationId): ?Operation
    {
        return $this->ops[$operationId] ?? null;
    }

    // --- indexing -----------------------------------------------------------

    private function index(): void
    {
        $paths = $this->root['paths'] ?? null;
        if (!is_array($paths)) {
            return;
        }
        foreach ($paths as $path => $item) {
            if (!is_array($item)) {
                continue;
            }
            foreach (self::HTTP_METHODS as $method) {
                $raw = $item[$method] ?? null;
                if (!is_array($raw)) {
                    continue;
                }
                $id = $raw['operationId'] ?? null;
                if (!is_string($id)) {
                    continue;
                }
                $op = new Operation();
                $op->operationId = $id;
                $this->loadParams($op, (string) $path, $item, $raw);
                $op->bodySchema = $this->bodySchema($raw);
                $this->loadStatuses($op, $raw);
                $this->ops[$id] = $op;
            }
        }
    }

    /** @param array<string,mixed> $item @param array<string,mixed> $raw */
    private function loadParams(Operation $op, string $path, array $item, array $raw): void
    {
        // Path-level parameters apply to every operation of the path item, then
        // operation-level ones.
        $byName = [];
        foreach ([$item['parameters'] ?? null, $raw['parameters'] ?? null] as $list) {
            if (!is_array($list)) {
                continue;
            }
            foreach ($list as $rawParam) {
                if (!is_array($rawParam)) {
                    continue;
                }
                $p = $this->resolve($rawParam);
                $name = $p['name'] ?? null;
                if (!is_string($name)) {
                    continue;
                }
                $param = new Param();
                $param->name = $name;
                $param->schema = isset($p['schema']) && is_array($p['schema']) ? $this->resolve($p['schema']) : null;
                $param->example = $p['example'] ?? ($param->schema['example'] ?? null);
                // Path parameters become positional arguments; query and header
                // parameters are gathered into separate array arguments.
                if (($p['in'] ?? null) === 'path') {
                    $byName[$name] = $param;
                } elseif (($p['in'] ?? null) === 'query') {
                    $op->queryParams[] = $param;
                } elseif (($p['in'] ?? null) === 'header') {
                    $op->headerParams[] = $param;
                }
            }
        }
        if (preg_match_all('/\{([^}]+)\}/', $path, $matches)) {
            foreach ($matches[1] as $pname) {
                if (isset($byName[$pname])) {
                    $op->pathParams[] = $byName[$pname];
                }
            }
        }
    }

    /** @param array<string,mixed> $raw @return array<string,mixed>|null */
    private function bodySchema(array $raw): ?array
    {
        $body = $raw['requestBody'] ?? null;
        if (!is_array($body)) {
            return null;
        }
        $body = $this->resolve($body);
        $json = $body['content']['application/json'] ?? null;
        if (!is_array($json) || !isset($json['schema']) || !is_array($json['schema'])) {
            return null;
        }
        return $this->resolve($json['schema']);
    }

    /** @param array<string,mixed> $raw */
    private function loadStatuses(Operation $op, array $raw): void
    {
        $responses = $raw['responses'] ?? null;
        if (!is_array($responses)) {
            return;
        }
        foreach ($responses as $key => $response) {
            if (!is_numeric((string) $key)) {
                continue; // "default" and the like carry no status.
            }
            $code = (int) $key;
            $op->statuses[$code] = true;
            if ($code >= 200 && $code < 300) {
                $op->hasSuccess = true;
            }
        }
    }

    // --- value synthesis ----------------------------------------------------

    /**
     * Query parameters keyed by their spec names, for jane's $queryParameters
     * OptionsResolver. Optional ones are included so they are exercised too.
     *
     * @return array<string,mixed>
     */
    public function queryValues(Operation $op): array
    {
        return $this->paramMap($op->queryParams);
    }

    /**
     * Header parameters keyed by their spec names, for jane's $headerParameters
     * OptionsResolver. Synthesized like query parameters.
     *
     * @return array<string,mixed>
     */
    public function headerValues(Operation $op): array
    {
        return $this->paramMap($op->headerParams);
    }

    /**
     * @param Param[] $params
     * @return array<string,mixed>
     */
    private function paramMap(array $params): array
    {
        $out = [];
        foreach ($params as $p) {
            $out[$p->name] = $this->paramValue($p);
        }
        return $out;
    }

    /** @return mixed */
    public function paramValue(Param $p)
    {
        if ($p->example !== null) {
            return $p->example;
        }
        return $this->synth($p->schema);
    }

    /**
     * Labels of the request body's top-level oneOf/anyOf members (the
     * discriminator value when declared, else the schema name), or an empty
     * array when the body is not a composite. Each member becomes its own case.
     *
     * @return string[]
     */
    public function bodyVariants(Operation $op): array
    {
        $members = $this->variants($op->bodySchema);
        if ($members === null) {
            return [];
        }
        $discriminator = (is_array($op->bodySchema) ? ($op->bodySchema['discriminator'] ?? null) : null);
        $labels = [];
        foreach ($members as $member) {
            $labels[] = $this->discriminatorValue(is_array($discriminator) ? $discriminator : [], $this->refOf($member));
        }
        return $labels;
    }

    /**
     * Synthesizes the request body, selecting the given top-level oneOf/anyOf
     * member. Returns null when the operation has no request body.
     *
     * @return mixed
     */
    public function bodyValue(Operation $op, int $variantIndex)
    {
        if ($op->bodySchema === null) {
            return null;
        }
        $members = $this->variants($op->bodySchema);
        if ($members !== null && $variantIndex < count($members)) {
            return $this->synthVariant($op->bodySchema, $members[$variantIndex]);
        }
        return $this->synth($op->bodySchema);
    }

    /**
     * @param array<string,mixed>|null $schema
     * @return mixed
     */
    private function synth(?array $schema)
    {
        if ($schema === null) {
            return null;
        }
        $schema = $this->resolve($schema);
        if (array_key_exists('example', $schema)) {
            return $schema['example'];
        }
        if (isset($schema['enum']) && is_array($schema['enum']) && $schema['enum'] !== []) {
            return $schema['enum'][0];
        }
        $members = $this->variants($schema);
        if ($members !== null) {
            return $this->synthVariant($schema, $members[0]);
        }
        if (isset($schema['allOf']) && is_array($schema['allOf'])) {
            return $this->synthObject($this->mergeAllOf($schema['allOf']));
        }
        $type = $schema['type'] ?? null;
        if ($type === null && isset($schema['properties']) && is_array($schema['properties'])) {
            $type = 'object';
        }
        if ($type === 'object') {
            return $this->synthObject($schema);
        }
        if ($type === 'array') {
            $items = $schema['items'] ?? null;
            $item = is_array($items) ? $this->synth($items) : null;
            return $item !== null ? [$item] : [];
        }
        return $this->synthScalar($schema);
    }

    /**
     * Fills every declared property, not just the required ones: an optional
     * property that is never sent leaves its own serialization — and the
     * required fields nested below it — unverified.
     *
     * @param array<string,mixed> $schema
     * @return array<string,mixed>
     */
    private function synthObject(array $schema)
    {
        $out = [];
        $props = $schema['properties'] ?? null;
        if (is_array($props)) {
            foreach ($props as $name => $prop) {
                if (is_array($prop)) {
                    $out[(string) $name] = $this->synth($prop);
                }
            }
        }
        // A required name with no property declaration still has to be present.
        $required = $schema['required'] ?? null;
        if (is_array($required)) {
            foreach ($required as $name) {
                if (!array_key_exists((string) $name, $out)) {
                    $out[(string) $name] = self::SYNTHETIC;
                }
            }
        }
        return $out;
    }

    /**
     * Composes the member schemas' properties, which is what allOf is used for
     * in these specs.
     *
     * @param array<int,mixed> $members
     * @return array<string,mixed>
     */
    private function mergeAllOf(array $members): array
    {
        $props = [];
        $required = [];
        foreach ($members as $member) {
            if (!is_array($member)) {
                continue;
            }
            $part = $this->resolve($member);
            if (isset($part['properties']) && is_array($part['properties'])) {
                $props = array_merge($props, $part['properties']);
            }
            if (isset($part['required']) && is_array($part['required'])) {
                $required = array_merge($required, $part['required']);
            }
        }
        return ['properties' => $props, 'required' => $required];
    }

    /**
     * Synthesizes one oneOf/anyOf member and, when the parent declares a
     * discriminator, sets the discriminator property so the value resolves to
     * that member (e.g. type: "fixed").
     *
     * @param array<string,mixed> $parent
     * @param mixed $member
     * @return mixed
     */
    private function synthVariant(array $parent, $member)
    {
        if (!is_array($member)) {
            return [];
        }
        $value = $this->synth($member);
        $discriminator = $parent['discriminator'] ?? null;
        if (!is_array($discriminator) || !is_array($value)) {
            return $value;
        }
        $property = $discriminator['propertyName'] ?? null;
        if (is_string($property)) {
            $value[$property] = $this->discriminatorValue($discriminator, $this->refOf($member));
        }
        return $value;
    }

    /** @param array<string,mixed> $schema @return mixed */
    private function synthScalar(array $schema)
    {
        $type = $schema['type'] ?? null;
        if ($type === 'integer' || $type === 'number') {
            return 1;
        }
        if ($type === 'boolean') {
            return true;
        }
        $format = $schema['format'] ?? null;
        if ($format === 'date') {
            return '2024-01-01';
        }
        if ($format === 'date-time') {
            return '2024-01-01T00:00:00Z';
        }
        // A string with no example still has to clear the declared minLength or
        // the mock rejects it; alphanumeric padding also satisfies the character
        // patterns these specs declare.
        $value = self::SYNTHETIC;
        $min = is_numeric($schema['minLength'] ?? null) ? (int) $schema['minLength'] : 0;
        while (strlen($value) < $min) {
            $value .= 'x';
        }
        return $value;
    }

    // --- small helpers ------------------------------------------------------

    /**
     * The oneOf or anyOf member list of a schema, or null when it is neither.
     *
     * @param array<string,mixed>|null $schema
     * @return array<int,mixed>|null
     */
    private function variants(?array $schema): ?array
    {
        if ($schema === null) {
            return null;
        }
        foreach (['oneOf', 'anyOf'] as $key) {
            if (isset($schema[$key]) && is_array($schema[$key]) && $schema[$key] !== []) {
                return array_values($schema[$key]);
            }
        }
        return null;
    }

    /**
     * The discriminator value whose mapping points at the given member
     * reference, falling back to the referenced schema name.
     *
     * @param array<string,mixed> $discriminator
     */
    private function discriminatorValue(array $discriminator, string $ref): string
    {
        $mapping = $discriminator['mapping'] ?? null;
        if (is_array($mapping) && $ref !== '') {
            foreach ($mapping as $value => $target) {
                if ((string) $target === $ref) {
                    return (string) $value;
                }
            }
        }
        if ($ref !== '' && ($pos = strrpos($ref, '/')) !== false) {
            return substr($ref, $pos + 1);
        }
        return self::SYNTHETIC;
    }

    /** @param mixed $member */
    private function refOf($member): string
    {
        if (is_array($member) && isset($member['$ref']) && is_string($member['$ref'])) {
            return $member['$ref'];
        }
        return '';
    }

    // --- $ref resolution ----------------------------------------------------

    /**
     * @param array<string,mixed> $node
     * @return array<string,mixed>
     */
    private function resolve(array $node): array
    {
        for ($i = 0; $i < 32; $i++) {
            $ref = $node['$ref'] ?? null;
            if (!is_string($ref)) {
                return $node;
            }
            $next = $this->resolveRef($ref);
            if ($next === null) {
                return [];
            }
            $node = $next;
        }
        return $node;
    }

    /** @return array<string,mixed>|null */
    private function resolveRef(string $ref): ?array
    {
        if (strncmp($ref, '#/', 2) !== 0) {
            return null;
        }
        $cur = $this->root;
        foreach (explode('/', substr($ref, 2)) as $seg) {
            $seg = str_replace(['~1', '~0'], ['/', '~'], $seg);
            if (!is_array($cur) || !array_key_exists($seg, $cur)) {
                return null;
            }
            $cur = $cur[$seg];
        }
        return is_array($cur) ? $cur : null;
    }

    // --- name mapping -------------------------------------------------------

    /** Generated jane method name = operationId with the first character lower-cased. */
    public static function methodName(string $operationId): string
    {
        return $operationId === '' ? $operationId : lcfirst($operationId);
    }

    /**
     * Generated argument name for a spec parameter name: separators are dropped
     * and the following character capitalised, with a lower-case first letter
     * (user_id -> userId, provider_name -> providerName), mirroring jane's
     * argument naming.
     */
    public static function argName(string $specParamName): string
    {
        $out = '';
        $capitalise = false;
        foreach (str_split($specParamName) as $c) {
            if ($c === '_' || $c === '-' || $c === '.' || $c === ' ') {
                $capitalise = true;
                continue;
            }
            $out .= $capitalise ? strtoupper($c) : $c;
            $capitalise = false;
        }
        return $out === '' ? $out : lcfirst($out);
    }
}
