<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\IsbnDbClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use ReflectionMethod;

abstract class ApiTestCase extends TestCase
{
    abstract protected function getApiClass(): string;

    protected function getApiMock(): MockObject
    {
        $httpClient = self::getMockBuilder(ClientInterface::class)
            ->onlyMethods(['sendRequest'])
            ->getMock();
        $httpClient
            ->expects(self::any())
            ->method('sendRequest');

        $client = IsbnDbClient::createWithHttpClient($httpClient);

        /** @psalm-suppress ArgumentTypeCoercion */
        return self::getMockBuilder($this->getApiClass())
            ->setMethods(['get', 'post', 'postRaw', 'patch', 'delete', 'put', 'head'])
            ->setConstructorArgs([$client])
            ->getMock();
    }

    protected function getMethod(object $object, string $methodName): ReflectionMethod
    {
        $method = new ReflectionMethod($object, $methodName);
        $method->setAccessible(true);

        return $method;
    }
}
