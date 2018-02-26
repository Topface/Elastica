<?php
namespace Elastica6\Test\Exception;

use Elastica6\Document;
use Elastica6\Exception\PartialShardFailureException;
use Elastica6\JSON;
use Elastica6\Query;
use Elastica6\ResultSet\DefaultBuilder;

class PartialShardFailureExceptionTest extends AbstractExceptionTest
{
    /**
     * @group functional
     */
    public function testPartialFailure()
    {
        $client = $this->_getClient();
        $index = $client->getIndex('elastica_partial_failure');
        $index->create([
            'index' => [
                'number_of_shards' => 5,
                'number_of_replicas' => 0,
            ],
        ], true);

        $type = $index->getType('folks');

        $type->addDocument(new Document('', ['name' => 'ruflin']));
        $type->addDocument(new Document('', ['name' => 'bobrik']));
        $type->addDocument(new Document('', ['name' => 'kimchy']));

        $index->refresh();

        $query = Query::create([
            'query' => [
                'bool' => [
                    'filter' => [
                        'script' => [
                            'script' => 'doc["undefined"] > 8', // compiles, but doesn't work
                        ],
                    ],
                ],
            ],
        ]);

        try {
            $index->search($query);

            $this->fail('PartialShardFailureException should have been thrown');
        } catch (PartialShardFailureException $e) {
            $builder = new DefaultBuilder();
            $resultSet = $builder->buildResultSet($e->getResponse(), $query);
            $this->assertEquals(0, count($resultSet->getResults()));

            $message = JSON::parse($e->getMessage());
            $this->assertTrue(isset($message['failures']), 'Failures are absent');
            $this->assertGreaterThan(0, count($message['failures']), 'Failures are empty');
        }
    }
}
