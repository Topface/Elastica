<?php
namespace Elastica6\Test\Query;

use Elastica6\Query\Type;
use Elastica6\Test\Base as BaseTest;

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
