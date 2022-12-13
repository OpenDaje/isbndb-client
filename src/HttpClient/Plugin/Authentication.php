<?php declare(strict_types=1);

namespace IsbnDbClient\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class Authentication implements Plugin
{
    public function __construct(
        private string $token
    ) {
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $request = $request->withHeader(
            'Authorization',
            $this->token
        );

        return $next($request);
    }
}
