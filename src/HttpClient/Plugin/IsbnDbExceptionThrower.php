<?php declare(strict_types=1);

namespace IsbnDbClient\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use IsbnDbClient\Exception\ErrorException;
use IsbnDbClient\Exception\RuntimeException;
use IsbnDbClient\HttpClient\Message\ResponseMediator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class IsbnDbExceptionThrower implements Plugin
{
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) use ($request) {
            if ($response->getStatusCode() < 400) {
                return $response;
            }

            $content = ResponseMediator::getContent($response);
            if (\is_array($content) && isset($content['message'])) {
                throw new ErrorException((string) $content['message']);
            }

            throw new RuntimeException($content['message'] ?? 'Unexpected exception', $response->getStatusCode());
        });
    }
}
