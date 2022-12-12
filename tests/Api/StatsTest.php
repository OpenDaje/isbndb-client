<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\Api\Stats;

/**
 * @covers \IsbnDbClient\Api\Stats
 */
class StatsTest extends ApiTestCase
{
    public function testShouldGetStatsDetails(): void
    {
        $expectedArray = [];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/stats')
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getStatus());
    }

    protected function getApiClass(): string
    {
        return Stats::class;
    }
}
