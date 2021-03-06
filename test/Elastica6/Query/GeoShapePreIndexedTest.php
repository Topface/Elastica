<?php
namespace Elastica6\Test\Query;

use Elastica6\Document;
use Elastica6\Query\AbstractGeoShape;
use Elastica6\Query\BoolQuery;
use Elastica6\Query\GeoShapePreIndexed;
use Elastica6\Test\Base as BaseTest;
use Elastica6\Type\Mapping;

class GeoShapePreIndexedTest extends BaseTest
{
    /**
     * @group functional
     */
    public function testSearch()
    {
        $index = $this->_createIndex();
        $indexName = $index->getName();
        $otherType = $index->getType('other_type');

        // create other type mapping
        $otherMapping = new Mapping($otherType, [
            'location' => [
                'type' => 'geo_shape',
            ],
        ]);
        $otherType->setMapping($otherMapping);

        // add other type docs
        $otherType->addDocument(new Document('2', [
            'location' => [
                'type' => 'envelope',
                'coordinates' => [
                    [25.0, 75.0],
                    [75.0, 25.0],
                ],
            ],
        ]));

        $index->forcemerge();
        $index->refresh();

        $gsp = new GeoShapePreIndexed(
            'location', '2', 'other_type', $indexName, 'location'
        );

        $query = new BoolQuery();
        $query->addFilter($gsp);

        $this->assertEquals(1, $otherType->count($query));

        $gsp->setRelation(AbstractGeoShape::RELATION_DISJOINT);
        $this->assertEquals(0, $otherType->count($query), 'Changing the relation should take effect');
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        $gsp = new GeoShapePreIndexed(
            'search_field', '1', 'type', 'index', 'indexed_field'
        );

        $expected = [
            'geo_shape' => [
                'search_field' => [
                    'indexed_shape' => [
                        'id' => '1',
                        'type' => 'type',
                        'index' => 'index',
                        'path' => 'indexed_field',
                    ],
                    'relation' => $gsp->getRelation(),
                ],
            ],
        ];

        $this->assertEquals($expected, $gsp->toArray());
    }

    /**
     * @group unit
     */
    public function testSetRelation()
    {
        $gsp = new GeoShapePreIndexed('location', '1', 'type', 'indexName', 'location');

        $this->assertEquals(AbstractGeoShape::RELATION_INTERSECT, $gsp->getRelation());
        $this->assertSame($gsp, $gsp->setRelation(AbstractGeoShape::RELATION_DISJOINT));
        $this->assertEquals(AbstractGeoShape::RELATION_DISJOINT, $gsp->getRelation());
    }
}
