<?php
namespace Elastica6\Test\Query;

use Elastica6\Query\ConstantScore;
use Elastica6\Query\Ids;
use Elastica6\Test\Base as BaseTest;

class ConstantScoreTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new ConstantScore();

        $boost = 1.2;
        $filter = new Ids();
        $filter->setIds([1]);
        $query->setFilter($filter);
        $query->setBoost($boost);

        $expectedArray = [
            'constant_score' => [
                'filter' => $filter->toArray(),
                'boost' => $boost,
            ],
        ];

        $this->assertEquals($expectedArray, $query->toArray());
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        $filter = new Ids();
        $filter->setIds([1]);

        $query = new ConstantScore($filter);

        $expectedArray = [
            'constant_score' => [
                'filter' => $filter->toArray(),
            ],
        ];

        $this->assertEquals($expectedArray, $query->toArray());
    }

    /**
     * @group unit
     */
    public function testConstructEmpty()
    {
        $query = new ConstantScore();
        $expectedArray = ['constant_score' => []];

        $this->assertEquals($expectedArray, $query->toArray());
    }
}
