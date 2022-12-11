<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\Api\Author;

/**
 * @covers \IsbnDbClient\Api\Author
 */
class AuthorTest extends ApiTestCase
{
    public function testShouldGetAuthorDetails(): void
    {
        $name = 'irrelevant';
        $queryParams = [
            'page' => '1',
            'pageSize' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
            'authorName' => 'irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/author/' . $name, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getAuthorDetails($name, $queryParams));
    }

    public function testShouldSearchAuthors(): void
    {
        $searchTerm = 'irrelevant';
        $queryParams = [
            'page' => '1',
            'pageSize' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
            'authorName' => 'irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/authors/' . $searchTerm, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->searchAuthors($searchTerm, $queryParams));
    }

    protected function getApiClass(): string
    {
        return Author::class;
    }
}
