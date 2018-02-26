<?php
namespace Elastica6\Test\Query;

use Elastica6\Query\GeohashCell;
use Elastica6\Test\DeprecatedClassBase;

class GeohashCellTest extends DeprecatedClassBase
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new GeohashCell('pin', ['lat' => 37.789018, 'lon' => -122.391506], '50m');
        $expected = [
            'geohash_cell' => [
                'pin' => [
                    'lat' => 37.789018,
                    'lon' => -122.391506,
                ],
                'precision' => '50m',
                'neighbors' => false,
            ],
        ];
        $this->assertEquals($expected, $query->toArray());
    }
}
