<?php declare(strict_types=1);

namespace IsbnDbClient\Tests;

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
}
