<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\HttpClient\Message;

use GuzzleHttp\Psr7\Response;
use IsbnDbClient\HttpClient\Message\ResponseMediator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \IsbnDbClient\HttpClient\Message\ResponseMediator
 */
class ResponseMediatorTest extends TestCase
{
    public function testGetContent(): void
    {
        $expectedBody = [
            'foo' => 'bar',
        ];
        $response = new Response(
            200,
            [
                'Content-Type' => 'application/json',
            ],
            \GuzzleHttp\Psr7\stream_for(json_encode($expectedBody))
        );

        self::assertSame($expectedBody, ResponseMediator::getContent($response));
    }

    /**
     * If content-type is not json we should get the raw body.
     */
    public function testGetContentNotJson(): void
    {
        $expectedBody = 'foobar';
        $response = new Response(
            200,
            [],
            \GuzzleHttp\Psr7\stream_for($expectedBody)
        );

        self::assertSame($expectedBody, ResponseMediator::getContent($response));
    }

    /**
     * Make sure we return the body if we have invalid json.
     */
    public function testGetContentInvalidJson(): void
    {
        $expectedBody = 'foobar';
        $response = new Response(
            200,
            [
                'Content-Type' => 'application/json',
            ],
            \GuzzleHttp\Psr7\stream_for($expectedBody)
        );

        self::assertSame($expectedBody, ResponseMediator::getContent($response));
    }
}
