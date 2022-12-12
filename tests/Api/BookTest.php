<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\Api\Book;

/**
 * @covers \IsbnDbClient\Api\Book
 */
class BookTest extends ApiTestCase
{
    public function testShouldGetBookDetails(): void
    {
        $isbn = 'irrelevant';
        $queryParams = [
            'page' => '1',
            'pageSize' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
            'title' => 'irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/book/' . $isbn, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getBookDetails($isbn, $queryParams));
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
            ->with('/books/' . $searchTerm, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->searchBooks($searchTerm, $queryParams));
    }

    protected function getApiClass(): string
    {
        return Book::class;
    }
}
