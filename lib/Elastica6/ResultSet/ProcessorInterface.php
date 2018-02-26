<?php
namespace Elastica6\ResultSet;

use Elastica6\ResultSet;

interface ProcessorInterface
{
    /**
     * Iterates over a ResultSet allowing a processor to iterate over any
     * Results as required.
     *
     * @param ResultSet $resultSet
     */
    public function process(ResultSet $resultSet);
}
