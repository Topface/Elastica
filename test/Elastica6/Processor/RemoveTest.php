<?php
namespace Elastica6\Test\Processor;

use Elastica6\Bulk;
use Elastica6\Document;
use Elastica6\Processor\Remove;
use Elastica6\ResultSet;
use Elastica6\Test\BasePipeline as BasePipelineTest;

class RemoveTest extends BasePipelineTest
{
    /**
     * @group unit
     */
    public function testRemove()
    {
        $processor = new Remove('foo');

        $expected = [
            'remove' => [
                'field' => 'foo',
            ],
        ];

        $this->assertEquals($expected, $processor->toArray());
    }

    /**
     * @group unit
     */
    public function testRemoveArray()
    {
        $processor = new Remove(['foo', 'bar']);

        $expected = [
            'remove' => [
                'field' => ['foo', 'bar'],
            ],
        ];

        $this->assertEquals($expected, $processor->toArray());
    }

    /**
     * @group functional
     */
    public function testRemoveField()
    {
        $remove = new Remove(['es_version', 'package']);

        $pipeline = $this->_createPipeline('my_custom_pipeline', 'pipeline for Remove');
        $pipeline->addProcessor($remove)->create();

        $index = $this->_createIndex();
        $type = $index->getType('bulk_test');

        // Add document to normal index
        $doc1 = new Document(null, ['name' => 'nicolas', 'es_version' => 6, 'package' => 'Elastica']);
        $doc2 = new Document(null, ['name' => 'ruflin', 'es_version' => 5, 'package' => 'Elastica_old']);

        $bulk = new Bulk($index->getClient());
        $bulk->setIndex($index);
        $bulk->setType($type);

        $bulk->addDocuments([
            $doc1,
            $doc2,
        ]);
        $bulk->setRequestParam('pipeline', 'my_custom_pipeline');

        $bulk->send();
        $index->refresh();

        /** @var ResultSet $result */
        $result = $index->search('*');

        $this->assertEquals(2, count($result->getResults()));

        foreach ($result->getResults() as $rx) {
            $value = $rx->getData();
            $this->assertArrayNotHasKey('package', $value);
            $this->assertArrayNotHasKey('es_version', $value);
        }
    }
}
