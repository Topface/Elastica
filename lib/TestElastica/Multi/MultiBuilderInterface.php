<?php
namespace TestElastica\Multi;

use TestElastica\Response;
use TestElastica\Search as BaseSearch;

interface MultiBuilderInterface
{
    /**
     * @param Response     $response
     * @param BaseSearch[] $searches
     *
     * @return ResultSet
     */
    public function buildMultiResultSet(Response $response, $searches);
}
