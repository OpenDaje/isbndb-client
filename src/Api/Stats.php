<?php declare(strict_types=1);

namespace IsbnDbClient\Api;

/**
 * @see https://isbndb.com/apidocs/v2
 */
class Stats extends AbstractApi
{
    /**
     * Returns a status object about the ISBNDB database.
     */
    public function getStatus(): array|string
    {
        return $this->get('/stats');
    }
}
