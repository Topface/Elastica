<?php
namespace Elastica6\Multi;

use Elastica6\Response;
use Elastica6\Search as BaseSearch;

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
