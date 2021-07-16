<?php
namespace Elastica6\Test\Query;

use Elastica6\Document;
use Elastica6\Query\SpanFirst;
use Elastica6\Query\SpanTerm;
use Elastica6\Test\Base as BaseTest;

class SpanFirstTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new SpanFirst();
        $query->setMatch(new SpanTerm(['user' => 'kimchy']));
        $query->setEnd(3);

        $data = $query->toArray();

        $this->assertEquals([
            'span_first' => [
                'match' => [
                    'span_term' => ['user' => 'kimchy'],
                ],
                'end' => 3,
            ],
        ], $data);
    }

    /**
     * @group functional
     */
    public function testSpanNearTerm()
    {
        $field = 'lorem';
        $value = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse odio lacus, aliquam nec nulla quis, aliquam eleifend eros.';

        $index = $this->_createIndex();
        $type = $index->getType('test');

        $docHitData = [$field => $value];
        $doc = new Document(1, $docHitData);
        $type->addDocument($doc);
        $index->refresh();

        $spanTerm = new SpanTerm([$field => ['value' => 'consectetur']]);

        // consectetur, end 4 won't match
        $spanNearQuery = new SpanFirst($spanTerm, 4);
        $resultSet = $type->search($spanNearQuery);
        $this->assertEquals(0, $resultSet->count());

        $spanTerm = new SpanTerm([$field => ['value' => 'lorem']]);

        // lorem, end 3 matches
        $spanNearQuery = new SpanFirst($spanTerm, 3);
        $resultSet = $type->search($spanNearQuery);
        $this->assertEquals(1, $resultSet->count());
    }
}