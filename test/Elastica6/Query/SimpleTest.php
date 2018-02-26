<?php
namespace Elastica6\Test\Query;

use Elastica6\Query\Simple;
use Elastica6\Test\Base as BaseTest;

class SimpleTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $testQuery = ['hello' => ['world'], 'name' => 'ruflin'];
        $query = new Simple($testQuery);

        $this->assertEquals($testQuery, $query->toArray());
    }
}
