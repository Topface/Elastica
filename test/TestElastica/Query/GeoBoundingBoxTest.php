<?php
namespace TestElastica\Test\Query;

use TestElastica\Query\GeoBoundingBox;
use TestElastica\Test\Base as BaseTest;

class GeoBoundingBoxTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testAddCoordinates()
    {
        $key = 'pin.location';
        $coords = ['40.73, -74.1', '40.01, -71.12'];
        $query = new GeoBoundingBox($key, ['1,2', '3,4']);

        $query->addCoordinates($key, $coords);
        $expectedArray = ['top_left' => $coords[0], 'bottom_right' => $coords[1]];
        $this->assertEquals($expectedArray, $query->getParam($key));

        $returnValue = $query->addCoordinates($key, $coords);
        $this->assertInstanceOf(GeoBoundingBox::class, $returnValue);
    }

    /**
     * @group unit
     * @expectedException \TestElastica\Exception\InvalidException
     */
    public function testAddCoordinatesInvalidException()
    {
        $query = new GeoBoundingBox('foo', []);
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $key = 'pin.location';
        $coords = ['40.73, -74.1', '40.01, -71.12'];
        $query = new GeoBoundingBox($key, $coords);

        $expectedArray = [
            'geo_bounding_box' => [
                $key => [
                    'top_left' => $coords[0],
                    'bottom_right' => $coords[1],
                ],
            ],
        ];

        $this->assertEquals($expectedArray, $query->toArray());
    }
}
