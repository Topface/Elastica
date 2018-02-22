<?php
namespace TestElastica\ResultSet;

use TestElastica\Query;
use TestElastica\Response;
use TestElastica\ResultSet;

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
