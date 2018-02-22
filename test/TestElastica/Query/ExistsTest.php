<?php
namespace TestElastica\Test\Query;

use TestElastica\Query\Exists;
use TestElastica\Test\Base as BaseTest;

class ExistsTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $field = 'test';
        $query = new Exists($field);

        $expectedArray = ['exists' => ['field' => $field]];
        $this->assertEquals($expectedArray, $query->toArray());
    }

    /**
     * @group unit
     */
    public function testSetField()
    {
        $field = 'test';
        $query = new Exists($field);

        $this->assertEquals($field, $query->getParam('field'));

        $newField = 'hello world';
        $this->assertInstanceOf(Exists::class, $query->setField($newField));

        $this->assertEquals($newField, $query->getParam('field'));
    }
}
