<?php
namespace Elastica6\Test\Processor;

use Elastica6\Bulk;
use Elastica6\Document;
use Elastica6\Processor\Uppercase;
use Elastica6\ResultSet;
use Elastica6\Test\BasePipeline as BasePipelineTest;

class UppercaseTest extends BasePipelineTest
{
    /**
     * @group unit
     */
    public function testUppercase()
    {
        $processor = new Uppercase('foo');

        $expected = [
            'uppercase' => [
                'field' => 'foo',
            ],
        ];

        $this->assertEquals($expected, $processor->toArray());
    }

    /**
     * @group functional
     */
    public function testUppercaseField()
    {
        $ucase = new Uppercase('name');

        $pipeline = $this->_createPipeline('my_custom_pipeline', 'pipeline for Uppercase');
        $pipeline->addProcessor($ucase)->create();

        $index = $this->_createIndex();
        $type = $index->getType('bulk_test');

        // Add document to normal index
        $doc1 = new Document(null, ['name' => 'ruflin']);
        $doc2 = new Document(null, ['name' => 'nicolas']);

        $bulk = new Bulk($index->getClient());
        $bulk->setIndex($index);
        $bulk->setType($type);

        $bulk->addDocuments([
            $doc1, $doc2,
        ]);
        $bulk->setRequestParam('pipeline', 'my_custom_pipeline');

        $bulk->send();
        $index->refresh();

        /** @var ResultSet $result */
        $result = $index->search('*');

        $this->assertEquals(2, count($result->getResults()));

        $results = $result->getResults();
        $this->assertSame('RUFLIN', ($results[0]->getHit())['_source']['name']);
        $this->assertSame('NICOLAS', ($results[1]->getHit())['_source']['name']);
    }
}
