<?php
namespace TestElastica\Test\Processor;

use TestElastica\Bulk;
use TestElastica\Document;
use TestElastica\Processor\Fail;
use TestElastica\Processor\Json;
use TestElastica\Test\BasePipeline as BasePipelineTest;

class FailTest extends BasePipelineTest
{
    /**
     * @group unit
     */
    public function testFail()
    {
        $processor = new Fail('This is a custom fail message for processor');

        $expected = [
            'fail' => [
                'message' => 'This is a custom fail message for processor',
            ],
        ];

        $this->assertEquals($expected, $processor->toArray());
    }

    /**
     * @group functional
     */
    public function testFailField()
    {
        $fail = new Fail('custom error fail message');
        $json = new Json('name');

        $pipeline = $this->_createPipeline('my_custom_pipeline', 'pipeline for Fail');
        $pipeline->addProcessor($json)
            ->addProcessor($fail)
            ->create();

        $index = $this->_createIndex();
        $type = $index->getType('bulk_test');

        // Add document to normal index
        $doc1 = new Document(null, ['name' => '']);

        $bulk = new Bulk($index->getClient());
        $bulk->setIndex($index);
        $bulk->setType($type);

        $bulk->addDocument($doc1);
        $bulk->setRequestParam('pipeline', 'my_custom_pipeline');

        try {
            $bulk->send();
            $index->refresh();
            $this->fail('test should raise an exception!');
        } catch (\Exception $e) {
            $this->assertContains('custom error fail message', $e->getMessage());
        }
    }
}
