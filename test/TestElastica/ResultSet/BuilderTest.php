<?php
namespace TestElastica\Test\ResultSet;

use TestElastica\Query;
use TestElastica\Response;
use TestElastica\ResultSet\DefaultBuilder;
use TestElastica\Test\Base as BaseTest;

/**
 * @group unit
 */
class BuilderTest extends BaseTest
{
    /**
     * @var DefaultBuilder
     */
    private $builder;

    protected function setUp()
    {
        parent::setUp();

        $this->builder = new DefaultBuilder();
    }

    public function testEmptyResponse()
    {
        $response = new Response('');
        $query = new Query();

        $resultSet = $this->builder->buildResultSet($response, $query);

        $this->assertSame($response, $resultSet->getResponse());
        $this->assertSame($query, $resultSet->getQuery());
        $this->assertCount(0, $resultSet->getResults());
    }

    public function testResponse()
    {
        $response = new Response([
            'hits' => [
                'hits' => [
                    ['test' => 1],
                    ['test' => 2],
                    ['test' => 3],
                ],
            ],
        ]);
        $query = new Query();

        $resultSet = $this->builder->buildResultSet($response, $query);

        $this->assertSame($response, $resultSet->getResponse());
        $this->assertSame($query, $resultSet->getQuery());
        $this->assertCount(3, $resultSet->getResults());
    }
}
