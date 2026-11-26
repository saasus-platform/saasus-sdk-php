<?php

namespace AntiPatternInc\Saasus\Test;

use AntiPatternInc\Saasus\Api\GuzzleMiddleware;
use AntiPatternInc\Saasus\Api\SdkVersion;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

final class GuzzleMiddlewareTest extends TestCase
{
    public function testAppendsSdkProductToOutgoingUserAgentOnce(): void
    {
        $middleware = new GuzzleMiddleware('secret', 'saas-id', 'api-key');
        $send = $middleware(static fn ($request) => $request);
        $request = new Request('GET', 'https://example.test/v1/auth/userinfo', ['user-agent' => 'Example/1.0']);
        $sent = $send($request, []);

        $userAgent = $sent->getHeaderLine('User-Agent');
        $this->assertSame('Example/1.0 SaaSus-SDK-php/' . SdkVersion::VERSION, $userAgent);
        $this->assertSame($userAgent, $send($sent, [])->getHeaderLine('User-Agent'));
    }
}
