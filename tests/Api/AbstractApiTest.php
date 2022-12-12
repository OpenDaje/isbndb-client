<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Http\Client\Common\HttpMethodsClientInterface;
use IsbnDbClient\Api\AbstractApi;
use IsbnDbClient\IsbnDbClient;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @covers \IsbnDbClient\Api\AbstractApi
 */
class AbstractApiTest extends ApiTestCase
{
    /**
     * @testdox should pass GET Request to client
     */
    public function testShouldPassGETRequestToClient(): void
    {
        $expectedArray = ['value'];

        $httpClient = self::getHttpMethodsMock(['get']);
        $httpClient
            ->expects(self::any())
            ->method('get')
            ->with('/path?param1=param1value', [
                'header1' => 'header1value',
            ])
            ->will(self::returnValue($this->getPSR7Response($expectedArray)));
        $isbnDbClient = self::getMockBuilder(IsbnDbClient::class)
            // added
            ->disableOriginalConstructor()
            ->onlyMethods(['getHttpClient'])
            ->getMock();
        $isbnDbClient->expects(self::any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($isbnDbClient);

        $actual = $this->getMethod($api, 'get')
            ->invokeArgs($api, [
                '/path', [
                    'param1' => 'param1value',
                ], [
                    'header1' => 'header1value',
                ], ]);

        self::assertSame($expectedArray, $actual);
    }

    private function getPSR7Response(array $expectedArray): Response
    {
        return new Response(
            200,
            [
                'Content-Type' => 'application/json',
            ],
            \GuzzleHttp\Psr7\stream_for(json_encode($expectedArray, JSON_THROW_ON_ERROR))
        );
    }

    protected function getHttpMethodsMock(array $methods = []): MockObject
    {
        $mock = self::createMock(HttpMethodsClientInterface::class);

        $mock
            ->expects(self::any())
            ->method('sendRequest');

        return $mock;
    }

    /**
     * @param MockObject&IsbnDbClient $client
     */
    protected function getAbstractApiObject($client): MockObject
    {
        return self::getMockBuilder($this->getApiClass())
            ->setMethods(null)
            ->setConstructorArgs([$client])
            ->getMock();
    }

    protected function getApiClass(): string
    {
        return AbstractApi::class;
    }
}
