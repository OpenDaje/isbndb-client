<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\HttpClient;

use Http\Client\Common\Plugin;
use IsbnDbClient\HttpClient\Builder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \IsbnDbClient\HttpClient\Builder
 */
class BuilderTest extends TestCase
{
    public function testShouldClearHeaders(): void
    {
        $builder = self::getMockBuilder(Builder::class)
            ->onlyMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $builder->expects(self::once())
            ->method('addPlugin')
            ->with(self::isInstanceOf(Plugin\HeaderAppendPlugin::class));

        $builder->expects(self::once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $builder->clearHeaders();
    }

    public function testShouldAddHeaders(): void
    {
        $headers = ['header1', 'header2'];

        $builder = self::getMockBuilder(Builder::class)
            ->onlyMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $builder->expects(self::once())
            ->method('addPlugin')
            // TODO verify that headers exists
            ->with(self::isInstanceOf(Plugin\HeaderAppendPlugin::class));

        $builder->expects(self::once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $builder->addHeaders($headers);
    }

    public function testAppendingHeaderShouldAddAndRemovePlugin(): void
    {
        $expectedHeaders = [
            'Accept' => 'application/json',
        ];

        $builder = self::getMockBuilder(Builder::class)
            ->onlyMethods(['removePlugin', 'addPlugin'])
            ->getMock();

        $builder->expects(self::once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $builder->expects(self::once())
            ->method('addPlugin')
            ->with(new Plugin\HeaderAppendPlugin($expectedHeaders));

        $builder->addHeaderValue('Accept', 'application/json');
    }
}
