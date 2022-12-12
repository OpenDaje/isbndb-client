<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\Api\Search;

/**
 * @covers \IsbnDbClient\Api\Search
 */
class SearchTest extends ApiTestCase
{
    public function testShouldSearchAll(): void
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
            ->with('/search/' . $searchTerm, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->searchAll($searchTerm, $queryParams));
    }

    protected function getApiClass(): string
    {
        return Search::class;
    }
}
