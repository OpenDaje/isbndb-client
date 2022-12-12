<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

/**
 * @see https://isbndb.com/apidocs/v2
 */
class Publisher extends AbstractApi
{
    /**
     * Returns details and a list of books by the publisher.
     *
     * @param string $name The name of a publisher in the Publisher's database
     * @param array $params keys page|pageSize
     */
    public function getPublisherDetails(string $name, array $params): array|string
    {
        return $this->get('/publisher/' . rawurlencode($name), $params);
    }

    /**
     * Returns details and a list of books by the publisher.
     *
     * @param string $searchTerm The name of a publisher in the Publisher's database
     * @param array $params keys page|pageSize
     */
    public function searchPublishers(string $searchTerm, array $params): array|string
    {
        return $this->get('/publishers/' . rawurlencode($searchTerm), $params);
    }
}
