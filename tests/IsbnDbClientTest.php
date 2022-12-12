<?php declare(strict_types=1);

namespace IsbnDbClient\Tests;

use IsbnDbClient\Api;
use IsbnDbClient\Exception\BadMethodCallException;
use IsbnDbClient\Exception\InvalidArgumentException;
use IsbnDbClient\IsbnDbClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

/**
 * @covers  \IsbnDbClient\IsbnDbClient
 */
class IsbnDbClientTest extends TestCase
{
    public function testShouldNotHaveToPassHttpClientToConstructor(): void
    {
        $isbnDbClient = new IsbnDbClient();

        self::assertInstanceOf(ClientInterface::class, $isbnDbClient->getHttpClient());
    }

    public function testShouldPassHttpClientInterfaceToNamedConstructor(): void
    {
        $httpClientMock = self::getMockBuilder(ClientInterface::class)
            ->getMock();

        $isbnDbClient = IsbnDbClient::createWithHttpClient($httpClientMock);

        self::assertInstanceOf(ClientInterface::class, $isbnDbClient->getHttpClient());
    }

    /**
     * @dataProvider getApiClassesProvider
     * @testdox Should get api instance for $apiName in resource class $class
     */
    public function testShouldGetApiInstance($apiName, $class): void
    {
        $isbnDbClient = new IsbnDbClient();

        self::assertInstanceOf($class, $isbnDbClient->api($apiName));
    }

    /**
     * @dataProvider getApiClassesProvider
     * @testdox Should get 'magic' api instance for $apiName in resource class $class
     */
    public function testShouldGetMagicApiInstance($apiName, $class): void
    {
        $isbnDbClient = new IsbnDbClient();

        self::assertInstanceOf($class, $isbnDbClient->$apiName());
    }

    public function testShouldNotGetApiInstance(): void
    {
        self::expectException(InvalidArgumentException::class);
        $isbnDbClient = new IsbnDbClient();
        $isbnDbClient->api('do_not_exist');
    }

    public function testShouldNotGetMagicApiInstance(): void
    {
        self::expectException(BadMethodCallException::class);
        $isbnDbClient = new IsbnDbClient();
        $isbnDbClient->doNotExist();
    }

    public function getApiClassesProvider(): array
    {
        return [
            ['author', Api\Author::class],
            ['publisher', Api\Publisher::class],
        ];
    }
}
