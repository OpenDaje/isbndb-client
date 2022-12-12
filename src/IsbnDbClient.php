<?php declare(strict_types=1);

namespace IsbnDbClient;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use IsbnDbClient\Api\AbstractApi;
use IsbnDbClient\Exception\BadMethodCallException;
use IsbnDbClient\Exception\InvalidArgumentException;
use IsbnDbClient\HttpClient\Builder;
use IsbnDbClient\HttpClient\Plugin\IsbnDbExceptionThrower;
use Psr\Http\Client\ClientInterface;

class IsbnDbClient
{
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();
        $builder->addPlugin(new IsbnDbExceptionThrower());
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'php-isbndb-api-client (https://github.com/OpenDaje/isbndb-client)',
            'Accept' => 'application/json',
        ]));
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://api2.isbndb.com')));
    }

    /**
     * Create a IsbnDbClient using an HTTP client.
     */
    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function api(string $name): AbstractApi
    {
        switch ($name) {
            case 'author':
                $api = new Api\Author($this);
                break;
            case 'publisher':
                $api = new Api\Publisher($this);
                break;

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
