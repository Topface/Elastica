<?php
namespace Elastica6\ResultSet;

use Elastica6\Query;
use Elastica6\Response;
use Elastica6\ResultSet;

interface BuilderInterface
{
    /**
     * Builds a ResultSet given a specific response and query.
     *
     * @param Response $response
     * @param Query    $query
     *
     * @return ResultSet
     */
    public function buildResultSet(Response $response, Query $query);
}
