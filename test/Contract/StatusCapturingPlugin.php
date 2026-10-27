<?php

namespace AntiPatternInc\Saasus\Test\Contract;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Records the HTTP status of the last response the client received.
 *
 * jane's FETCH_OBJECT call form only returns the deserialized body (or null)
 * and never surfaces the status, and its generated endpoints let an HTTP status
 * they do not explicitly handle fall through {@code transformResponseBody} to a
 * null return without throwing. Without the real status, such an undeclared
 * error (e.g. 422/503 on an operation that models no success body) would be
 * indistinguishable from a legitimate bodyless 2xx and pass. Reading it here
 * lets the round trip assert the status is a success, mirroring Go reading
 * {@code HTTPResponse.StatusCode} and Java reading {@code ApiException.getCode()}.
 */
final class StatusCapturingPlugin implements Plugin
{
    /** Status code of the most recent response, or null before any call. */
    public ?int $status = null;

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) {
            $this->status = $response->getStatusCode();
            return $response;
        });
    }
}
