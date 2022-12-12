<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

/**
 * @see https://isbndb.com/apidocs/v2
 */
class Book extends AbstractApi
{
    /**
     * Returns the book details
     *
     * @param string $isbn an ISBN 10 or ISBN 13 in the Books database
     * @param array $params keys with_prices
     */
    public function getBookDetails(string $isbn, array $params): array|string
    {
        return $this->get('/book/' . rawurlencode($isbn), $params);
    }

    /**
     * This returns a list of books that match the query.
     *
     * @param string $searchTerm A string to search for in the Book’s database
     * @param array $params keys page|pageSize|column
     */
    public function searchBooks(string $searchTerm, array $params): array|string
    {
        return $this->get('/books/' . rawurlencode($searchTerm), $params);
    }
}
