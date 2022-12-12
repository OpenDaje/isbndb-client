<?php declare(strict_types=1);

namespace IsbnDbClient\Tests\Api;

use IsbnDbClient\Api\Subject;

/**
 * @covers \IsbnDbClient\Api\Subject
 */
class SubjectTest extends ApiTestCase
{
    public function testShouldGetSubjectDetails(): void
    {
        $name = 'irrelevant';
        $expectedArray = [[
            'subject' => 'irrelevant',
            'parent' => 'parent irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/subject/' . $name)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getSubjectDetails($name));
    }

    public function testShouldSearchSubjects(): void
    {
        $searchTerm = 'irrelevant';
        $queryParams = [
            'page' => '1',
            'pageSize' => '100',
        ];
        $expectedArray = [[
            'subject' => 'irrelevant',
            'parent' => 'parent irrelevant',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/subjects/' . $searchTerm, $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->searchSubjects($searchTerm, $queryParams));
    }

    protected function getApiClass(): string
    {
        return Subject::class;
    }
}
