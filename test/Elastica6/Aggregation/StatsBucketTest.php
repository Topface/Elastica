<?php
namespace Elastica6\Test\Aggregation;

use Elastica6\Aggregation\Histogram;
use Elastica6\Aggregation\Max;
use Elastica6\Aggregation\StatsBucket;
use Elastica6\Document;
use Elastica6\Query;

class StatsBucketTest extends BaseAggregationTest
{
    protected function _getIndexForTest()
    {
        $index = $this->_createIndex();

        $index->getType('test')->addDocuments([
            Document::create(['weight' => 60, 'height' => 180, 'age' => 25]),
            Document::create(['weight' => 70, 'height' => 156, 'age' => 32]),
            Document::create(['weight' => 50, 'height' => 155, 'age' => 45]),
        ]);

        $index->refresh();

        return $index;
    }

    /**
     * @group functional
     */
    public function testStatBucketAggregation()
    {
        $bucketScriptAggregation = new StatsBucket('result', 'age_groups>max_weight');

        $histogramAggregation = new Histogram('age_groups', 'age', 10);

        $histogramAggregation->addAggregation((new Max('max_weight'))->setField('weight'));

        $query = Query::create([])
            ->addAggregation($histogramAggregation)
            ->addAggregation($bucketScriptAggregation);

        $results = $this->_getIndexForTest()->search($query)->getAggregation('result');

        $this->assertEquals(3, $results['count']);
        $this->assertEquals(50, $results['min']);
        $this->assertEquals(70, $results['max']);
        $this->assertEquals(60, $results['avg']);
        $this->assertEquals(180, $results['sum']);
    }

    /**
     * @group unit
     */
    public function testConstructThroughSetters()
    {
        $serialDiffAgg = new StatsBucket('bucket_part');

        $serialDiffAgg
            ->setBucketsPath('age_groups>max_weight')
            ->setFormat('test_format')
            ->setGapPolicy(10);

        $expected = [
            'stats_bucket' => [
                'buckets_path' => 'age_groups>max_weight',
                'format' => 'test_format',
                'gap_policy' => 10,
            ],
        ];

        $this->assertEquals($expected, $serialDiffAgg->toArray());
    }

    /**
     * @group unit
     * @expectedException \Elastica6\Exception\InvalidException
     */
    public function testToArrayInvalidBucketsPath()
    {
        $serialDiffAgg = new StatsBucket('bucket_part');
        $serialDiffAgg->toArray();
    }
}
