<?php
namespace TestElastica\Test\Query;

use TestElastica\Query\Type;
use TestElastica\Test\Base as BaseTest;

class TypeTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testSetType()
    {
        $typeQuery = new Type();
        $returnValue = $typeQuery->setType('type_name');
        $this->assertInstanceOf(Type::class, $returnValue);
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $typeQuery = new Type('type_name');

        $expectedArray = [
            'type' => ['value' => 'type_name'],
        ];

        $this->assertEquals($expectedArray, $typeQuery->toArray());
    }
}
