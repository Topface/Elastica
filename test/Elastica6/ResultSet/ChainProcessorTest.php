<?php
namespace Elastica6\Test\Transformer;

use Elastica6\Query;
use Elastica6\Response;
use Elastica6\ResultSet;
use Elastica6\ResultSet\ChainProcessor;
use Elastica6\ResultSet\ProcessorInterface;
use Elastica6\Test\Base as BaseTest;

/**
 * @group unit
 */
class ChainProcessorTest extends BaseTest
{
    public function testProcessor()
    {
        $processor = new ChainProcessor([
            $processor1 = $this->createMock(ProcessorInterface::class),
            $processor2 = $this->createMock(ProcessorInterface::class),
        ]);
        $resultSet = new ResultSet(new Response(''), new Query(), []);

        $processor1->expects($this->once())
            ->method('process')
            ->with($resultSet);
        $processor2->expects($this->once())
            ->method('process')
            ->with($resultSet);

        $processor->process($resultSet);
    }
}
