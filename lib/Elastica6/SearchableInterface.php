<?php
namespace Elastica6;

/**
 * Elastica6 searchable interface.
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
interface SearchableInterface
{
    /**
     * Searches results for a query.
     *
     * {
     *     "from" : 0,
     *     "size" : 10,
     *     "sort" : {
     *          "postDate" : {"order" : "desc"},
     *          "user" : { },
     *          "_score" : { }
     *      },
     *      "query" : {
     *          "term" : { "user" : "kimchy" }
     *      }
     * }
     *
     * @param string|array|\Elastica6\Query $query Array with all query data inside or a Elastica6\Query object
     * @param null                             $options
     *
     * @return \Elastica6\ResultSet with all results inside
     */
    public function search($query = '', $options = null);

    /**
     * Counts results for a query.
     *
     * If no query is set, matchall query is created
     *
     * @param string|array|\Elastica6\Query $query Array with all query data inside or a Elastica6\Query object
     *
     * @return int number of documents matching the query
     */
    public function count($query = '');

    /**
     * @param \Elastica6\Query|string $query
     * @param array                      $options
     *
     * @return \Elastica6\Search
     */
    public function createSearch($query = '', $options = null);
}
