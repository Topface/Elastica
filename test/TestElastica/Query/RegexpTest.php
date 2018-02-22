<?php
namespace TestElastica\Test\Query;

use TestElastica\Query\Regexp;
use TestElastica\Test\Base as BaseTest;

class RegexpTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $field = 'name';
        $value = 'ruf';
        $boost = 2;

        $query = new Regexp($field, $value, $boost);

        $expectedArray = [
            'regexp' => [
                $field => [
                    'value' => $value,
                    'boost' => $boost,
                ],
            ],
        ];

        $this->assertequals($expectedArray, $query->toArray());
    }
}
