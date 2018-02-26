<?php
namespace Elastica6\Test\Aggregation;

use Elastica6\Aggregation\AbstractSimpleAggregation;
use Elastica6\Exception\InvalidException;

class AbstractSimpleAggregationTest extends BaseAggregationTest
{
    protected function setUp()
    {
        $this->aggregation = $this->getMockForAbstractClass(
            AbstractSimpleAggregation::class,
            ['whatever']
        );
    }

    public function testToArrayThrowsExceptionOnUnsetParams()
    {
        $this->expectException(InvalidException::class);
        $this->expectExceptionMessage('Either the field param or the script param should be set');

        $this->aggregation->toArray();
    }
}
