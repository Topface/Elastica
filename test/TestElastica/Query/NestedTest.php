<?php
namespace TestElastica\Test\Query;

use TestElastica\Query\Nested;
use TestElastica\Query\QueryString;
use TestElastica\Test\Base as BaseTest;

class NestedTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testSetQuery()
    {
        $nested = new Nested();
        $path = 'test1';

        $queryString = new QueryString('test');
        $this->assertInstanceOf(Nested::class, $nested->setQuery($queryString));
        $this->assertInstanceOf(Nested::class, $nested->setPath($path));
        $expected = [
            'nested' => [
                'query' => $queryString->toArray(),
                'path' => $path,
            ],
        ];

        $this->assertEquals($expected, $nested->toArray());
    }
}
