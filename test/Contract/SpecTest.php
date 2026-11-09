<?php

namespace AntiPatternInc\Saasus\Test\Contract;

use PHPUnit\Framework\TestCase;

/**
 * Unit coverage for the input synthesis, run without a mock. These exercise
 * paths the live round trip may not (query/header gathering, anyOf bodies, the
 * forward-compat unknown-key parser) and pin the name mapping that binds spec
 * parameters to jane arguments.
 */
class SpecTest extends TestCase
{
    /** Writes a spec document to a temp dir and loads it through the normal entry point. */
    private function writeSpec(string $document): Spec
    {
        $dir = sys_get_temp_dir() . '/contract-spec-' . uniqid();
        mkdir($dir);
        file_put_contents($dir . '/test.yml', $document);
        $spec = Spec::load($dir, 'test');
        $this->assertNotNull($spec, 'spec failed to load');
        return $spec;
    }

    public function testMethodNameLowercasesFirstCharacter(): void
    {
        $this->assertSame('getUserInfo', Spec::methodName('GetUserInfo'));
        $this->assertSame('createTenantUserRoles', Spec::methodName('CreateTenantUserRoles'));
    }

    public function testArgNameMirrorsJaneCamelCasing(): void
    {
        $this->assertSame('userId', Spec::argName('user_id'));
        $this->assertSame('providerName', Spec::argName('provider_name'));
        $this->assertSame('envId', Spec::argName('env_id'));
        $this->assertSame('createdDate', Spec::argName('created_date'));
    }

    /**
     * Query parameters are synthesized keyed by their spec names (optional ones
     * included), and the path parameter stays a positional argument rather than
     * joining the query array.
     */
    public function testQueryValuesKeyedBySpecNameAndPathStaysPositional(): void
    {
        $spec = $this->writeSpec(
            "openapi: 3.0.0\n" .
            "paths:\n" .
            "  /tenants/{tenant_id}/users:\n" .
            "    parameters:\n" .
            "      - name: tenant_id\n" .
            "        in: path\n" .
            "        schema: { type: string }\n" .
            "        example: tenant-1\n" .
            "    get:\n" .
            "      operationId: GetUsers\n" .
            "      parameters:\n" .
            "        - name: limit\n" .
            "          in: query\n" .
            "          schema: { type: integer }\n" .
            "          example: 10\n" .
            "        - name: cursor\n" .
            "          in: query\n" .
            "          schema: { type: string }\n" .
            "          example: abc\n" .
            "      responses:\n" .
            "        '200': { description: ok }\n"
        );

        $op = $spec->operation('GetUsers');
        $this->assertNotNull($op);
        $this->assertSame(['limit' => 10, 'cursor' => 'abc'], $spec->queryValues($op));
        $this->assertCount(1, $op->pathParams);
        $this->assertSame('tenant_id', $op->pathParams[0]->name);
    }

    /**
     * Header parameters are synthesized into their own map (keyed by spec name)
     * just like query parameters, so a required header is sent and an optional
     * one is exercised; they do not leak into the query map, and a path
     * parameter stays positional.
     */
    public function testHeaderParametersSynthesizedSeparatelyFromQuery(): void
    {
        $spec = $this->writeSpec(
            "openapi: 3.0.0\n" .
            "paths:\n" .
            "  /tenants/{tenant_id}/items:\n" .
            "    get:\n" .
            "      operationId: GetItems\n" .
            "      parameters:\n" .
            "        - name: tenant_id\n" .
            "          in: path\n" .
            "          schema: { type: string }\n" .
            "          example: tenant-1\n" .
            "        - name: filter\n" .
            "          in: query\n" .
            "          schema: { type: string }\n" .
            "          example: f-1\n" .
            "        - name: X-Saasus-Referer\n" .
            "          in: header\n" .
            "          schema: { type: string }\n" .
            "          example: https://example.com\n" .
            "      responses:\n" .
            "        '200': { description: ok }\n"
        );

        $op = $spec->operation('GetItems');
        $this->assertNotNull($op);
        $this->assertSame(['filter' => 'f-1'], $spec->queryValues($op));
        $this->assertSame(['X-Saasus-Referer' => 'https://example.com'], $spec->headerValues($op));
        $this->assertCount(1, $op->pathParams);
        $this->assertSame('tenant_id', $op->pathParams[0]->name);
    }

    /**
     * The forward-compat resend drops only the keys an older SDK reports as
     * unknown, parsed from the OptionsResolver message (one or several names),
     * so every supported parameter is kept.
     */
    public function testUndefinedOptionNamesParsing(): void
    {
        $this->assertSame(
            ['filter'],
            ContractTest::undefinedOptionNames('The option "filter" does not exist. Defined options are: "token".')
        );
        $this->assertSame(
            ['filter', 'sort'],
            ContractTest::undefinedOptionNames('The options "filter", "sort" do not exist. Defined options are: "token".')
        );
        $this->assertSame([], ContractTest::undefinedOptionNames('some unrelated message'));
    }

    /**
     * Every member of a composite request body is sent, for anyOf as well as
     * oneOf, with the discriminator property set to resolve the chosen member.
     */
    public function testBodyVariantsCoverOneOfAndAnyOf(): void
    {
        foreach (['oneOf', 'anyOf'] as $keyword) {
            $spec = $this->writeSpec(
                "openapi: 3.0.0\n" .
                "paths:\n" .
                "  /units:\n" .
                "    post:\n" .
                "      operationId: SaveUnit\n" .
                "      requestBody:\n" .
                "        content:\n" .
                "          application/json:\n" .
                "            schema: { \$ref: '#/components/schemas/UnitForSave' }\n" .
                "      responses:\n" .
                "        '200': { description: ok }\n" .
                "components:\n" .
                "  schemas:\n" .
                "    UnitForSave:\n" .
                "      {$keyword}:\n" .
                "        - \$ref: '#/components/schemas/FixedUnit'\n" .
                "        - \$ref: '#/components/schemas/UsageUnit'\n" .
                "      discriminator:\n" .
                "        propertyName: type\n" .
                "        mapping:\n" .
                "          fixed: '#/components/schemas/FixedUnit'\n" .
                "          usage: '#/components/schemas/UsageUnit'\n" .
                "    FixedUnit:\n" .
                "      type: object\n" .
                "      properties:\n" .
                "        name: { type: string, example: fixed-unit }\n" .
                "    UsageUnit:\n" .
                "      type: object\n" .
                "      properties:\n" .
                "        name: { type: string, example: usage-unit }\n"
            );

            $op = $spec->operation('SaveUnit');
            $this->assertSame(['fixed', 'usage'], $spec->bodyVariants($op), $keyword);
            $this->assertSame(['name' => 'usage-unit', 'type' => 'usage'], $spec->bodyValue($op, 1), $keyword);
        }
    }

    /** A required property with no declaration is still present in the synthesized body. */
    public function testSynthObjectFillsUndeclaredRequired(): void
    {
        $spec = $this->writeSpec(
            "openapi: 3.0.0\n" .
            "paths:\n" .
            "  /things:\n" .
            "    post:\n" .
            "      operationId: CreateThing\n" .
            "      requestBody:\n" .
            "        content:\n" .
            "          application/json:\n" .
            "            schema:\n" .
            "              type: object\n" .
            "              required: [name, kind]\n" .
            "              properties:\n" .
            "                name: { type: string, example: n-1 }\n" .
            "      responses:\n" .
            "        '200': { description: ok }\n"
        );

        $op = $spec->operation('CreateThing');
        $this->assertSame(['name' => 'n-1', 'kind' => Spec::SYNTHETIC], $spec->bodyValue($op, 0));
    }

    /** hasSuccess and the declared status set reflect the operation's responses. */
    public function testStatusesAndSuccessFlag(): void
    {
        $spec = $this->writeSpec(
            "openapi: 3.0.0\n" .
            "paths:\n" .
            "  /with-body:\n" .
            "    get:\n" .
            "      operationId: WithBody\n" .
            "      responses:\n" .
            "        '200':\n" .
            "          description: ok\n" .
            "          content:\n" .
            "            application/json:\n" .
            "              schema: { type: object }\n" .
            "  /only-error:\n" .
            "    get:\n" .
            "      operationId: OnlyError\n" .
            "      responses:\n" .
            "        '500': { description: boom }\n"
        );

        $this->assertTrue($spec->operation('WithBody')->hasSuccess);
        $this->assertArrayHasKey(200, $spec->operation('WithBody')->statuses);

        $this->assertFalse($spec->operation('OnlyError')->hasSuccess);
        $this->assertArrayHasKey(500, $spec->operation('OnlyError')->statuses);
    }
}
