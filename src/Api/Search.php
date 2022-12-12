<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

/**
 * @see https://isbndb.com/apidocs/v2
 */
class Search extends AbstractApi
{
    /**
     * Uses a determined index and query string to search in any of the ISBNDB's databases.
     *
     * @param string $searchTerm The name of a publisher in the Publisher's database
     * @param array $params keys page|pageSize|isbn|isbn13|author|text|subject|publisher
     */
    public function searchAll(string $searchTerm, array $params): array|string
    {
        return $this->get('/search/' . rawurlencode($searchTerm), $params);
    }
}
