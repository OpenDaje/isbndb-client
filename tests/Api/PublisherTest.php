<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\Api\Publisher;

/**
 * @covers \IsbnDbClient\Api\Publisher
 */
class PublisherTest extends ApiTestCase
{
    public function testShouldGetPublisherDetails(): void
    {
        $name = 'irrelevant';
        $queryParams = [
            'page' => '1',
            'pageSize' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
            'publisherName' => 'irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/publisher/' . $name, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getPublisherDetails($name, $queryParams));
    }

    public function testShouldSearchPublishers(): void
    {
        $searchTerm = 'irrelevant';
        $queryParams = [
            'page' => '1',
            'pageSize' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
            'publisherName' => 'irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/publishers/' . $searchTerm, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->searchPublishers($searchTerm, $queryParams));
    }

    protected function getApiClass(): string
    {
        return Publisher::class;
    }
}
