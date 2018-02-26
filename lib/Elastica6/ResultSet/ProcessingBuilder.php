<?php
namespace Elastica6\ResultSet;

use Elastica6\Query;
use Elastica6\Response;
use Elastica6\ResultSet;

class ProcessingBuilder implements BuilderInterface
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var ProcessorInterface
     */
    private $processor;

    /**
     * @param BuilderInterface   $builder
     * @param ProcessorInterface $processor
     */
    public function __construct(BuilderInterface $builder, ProcessorInterface $processor)
    {
        $this->builder = $builder;
        $this->processor = $processor;
    }

    /**
     * Runs any registered transformers on the ResultSet before
     * returning it, allowing the transformers to inject additional
     * data into each Result.
     *
     * @param Response $response
     * @param Query    $query
     *
     * @return ResultSet
     */
    public function buildResultSet(Response $response, Query $query)
    {
        $resultSet = $this->builder->buildResultSet($response, $query);

        $this->processor->process($resultSet);

        return $resultSet;
    }
}
