<?php
namespace Elastica6\Multi;

use Elastica6\Response;
use Elastica6\Search as BaseSearch;

class MultiBuilder implements MultiBuilderInterface
{
    /**
     * @param Response     $response
     * @param BaseSearch[] $searches
     *
     * @return ResultSet
     */
    public function buildMultiResultSet(Response $response, $searches)
    {
        $resultSets = $this->buildResultSets($response, $searches);

        return new ResultSet($response, $resultSets);
    }

    /**
     * @param Response   $childResponse
     * @param BaseSearch $search
     *
     * @return \Elastica6\ResultSet
     */
    private function buildResultSet(Response $childResponse, BaseSearch $search)
    {
        return $search->getResultSetBuilder()->buildResultSet($childResponse, $search->getQuery());
    }

    /**
     * @param Response     $response
     * @param BaseSearch[] $searches
     *
     * @return \Elastica6\ResultSet[]
     */
    private function buildResultSets(Response $response, $searches)
    {
        $data = $response->getData();
        if (!isset($data['responses']) || !is_array($data['responses'])) {
            return [];
        }

        $resultSets = [];
        reset($searches);

        foreach ($data['responses'] as $responseData) {
            $search = current($searches);
            $key = key($searches);
            next($searches);

            $resultSets[$key] = $this->buildResultSet(new Response($responseData), $search);
        }

        return $resultSets;
    }
}
