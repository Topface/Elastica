<?php
namespace Elastica6\Test\Query;

use Elastica6\Query\Nested;
use Elastica6\Query\QueryString;
use Elastica6\Test\Base as BaseTest;

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
