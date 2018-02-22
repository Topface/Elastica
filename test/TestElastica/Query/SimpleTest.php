<?php
namespace TestElastica\Test\Query;

use TestElastica\Query\Simple;
use TestElastica\Test\Base as BaseTest;

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
