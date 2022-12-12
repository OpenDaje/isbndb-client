<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

/**
 * @see https://isbndb.com/apidocs/v2
 */
class Subject extends AbstractApi
{
    /**
     * Returns details and a list of books with subject.
     *
     * @param string $name A subject in the Subject's database
     */
    public function getSubjectDetails(string $name): array|string
    {
        return $this->get('/subject/' . rawurlencode($name));
    }

    /**
     * This returns a list of subjects that match the given query.
     *
     * @param string $searchTerm A string to search for in the Subject’s database
     * @param array $params keys page|pageSize
     */
    public function searchSubjects(string $searchTerm, array $params): array|string
    {
        return $this->get('/subjects/' . rawurlencode($searchTerm), $params);
    }
}
