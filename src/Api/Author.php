<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

/**
 * @see https://isbndb.com/apidocs/v2
 */
class Author extends AbstractApi
{
    /**
     * Returns the name and a list of books by the author.
     *
     * @param string $name The name of an author in the Author's database
     * @param array $params keys page|pageSize
     */
    public function getAuthorDetails(string $name, array $params = []): array|string
    {
        return $this->get('/author/' . rawurlencode($name), $params);
    }

    /**
     * Returns the name and a list of books by the author.
     *
     * @param string $searchTerm A string to search for in the Author’s database
     * @param array $params keys page|pageSize
     */
    public function searchAuthors(string $searchTerm, array $params = []): array|string
    {
        return $this->get('/authors/' . rawurlencode($searchTerm), $params);
    }
}
