<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

use IsbnDbClient\HttpClient\Message\ResponseMediator;
use IsbnDbClient\IsbnDbClient;

abstract class AbstractApi
{
    public function __construct(
        private IsbnDbClient $client
    ) {
    }

    /**
     * Get the client instance.
     */
    protected function getClient(): IsbnDbClient
    {
        return $this->client;
    }

    /**
     * @return $this
     */
    public function configure()
    {
        return $this;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters GET parameters.
     * @param array $requestHeaders Request Headers.
     */
    protected function get(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        if (\count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        $response = $this->client->getHttpClient()->get($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }
}
