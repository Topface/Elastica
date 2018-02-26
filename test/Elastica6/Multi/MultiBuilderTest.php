<?php
namespace Elastica6\Test\Multi;

use Elastica6\Multi\MultiBuilder;
use Elastica6\Multi\ResultSet as MultiResultSet;
use Elastica6\Response;
use Elastica6\ResultSet;
use Elastica6\ResultSet\BuilderInterface;
use Elastica6\Search;
use Elastica6\Test\Base as BaseTest;

/**
 * @group unit
 */
class MultiBuilderTest extends BaseTest
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var MultiBuilder
     */
    private $multiBuilder;

    protected function setUp()
    {
        parent::setUp();

        $this->builder = $this->createMock(BuilderInterface::class);
        $this->multiBuilder = new MultiBuilder($this->builder);
    }

    public function testBuildEmptyMultiResultSet()
    {
        $this->builder->expects($this->never())
            ->method('buildResultSet');

        $response = new Response([]);
        $searches = [];

        $result = $this->multiBuilder->buildMultiResultSet($response, $searches);

        $this->assertInstanceOf(MultiResultSet::class, $result);
    }

    public function testBuildMultiResultSet()
    {
        $response = new Response([
            'responses' => [
                [],
                [],
            ],
        ]);
        $searches = [
            $s1 = new Search($this->_getClient(), $this->builder),
            $s2 = new Search($this->_getClient(), $this->builder),
        ];
        $resultSet1 = new ResultSet(new Response([]), $s1->getQuery(), []);
        $resultSet2 = new ResultSet(new Response([]), $s2->getQuery(), []);

        $this->builder->expects($this->exactly(2))
            ->method('buildResultSet')
            ->withConsecutive(
                [$this->isInstanceOf(Response::class), $s1->getQuery()],
                [$this->isInstanceOf(Response::class), $s2->getQuery()]
            )
            ->willReturnOnConsecutiveCalls($resultSet1, $resultSet2);

        $result = $this->multiBuilder->buildMultiResultSet($response, $searches);

        $this->assertInstanceOf(MultiResultSet::class, $result);
        $this->assertSame($resultSet1, $result[0]);
        $this->assertSame($resultSet2, $result[1]);
    }
}
