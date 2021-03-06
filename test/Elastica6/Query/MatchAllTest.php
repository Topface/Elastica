<?php
namespace Elastica6\Test\Query;

use Elastica6\Document;
use Elastica6\Query\MatchAll;
use Elastica6\Search;
use Elastica6\Test\Base as BaseTest;

class MatchAllTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new MatchAll();

        $expectedArray = ['match_all' => new \stdClass()];

        $this->assertEquals($expectedArray, $query->toArray());
    }

    /**
     * @group functional
     */
    public function testMatchAllIndicesTypes()
    {
        $index1 = $this->_createIndex();

        $client = $index1->getClient();

        $search1 = new Search($client);
        $resultSet1 = $search1->search(new MatchAll());

        $doc1 = new Document(1, ['name' => 'kimchy']);
        $doc2 = new Document(2, ['name' => 'ruflin']);
        $index1->getType('test')->addDocuments([$doc1, $doc2]);

        $index1->refresh();

        $search2 = new Search($client);
        $resultSet2 = $search2->search(new MatchAll());

        $this->assertEquals($resultSet1->getTotalHits() + 2, $resultSet2->getTotalHits());
    }
}
