<?php
namespace TestElastica\Test\Transformer;

use TestElastica\Query;
use TestElastica\Response;
use TestElastica\ResultSet;
use TestElastica\ResultSet\ChainProcessor;
use TestElastica\ResultSet\ProcessorInterface;
use TestElastica\Test\Base as BaseTest;

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
