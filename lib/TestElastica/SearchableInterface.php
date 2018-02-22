<?php
namespace TestElastica;

/**
 * TestElastica searchable interface.
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
     * @param string|array|\TestElastica\Query $query Array with all query data inside or a TestElastica\Query object
     * @param null                             $options
     *
     * @return \TestElastica\ResultSet with all results inside
     */
    public function search($query = '', $options = null);

    /**
     * Counts results for a query.
     *
     * If no query is set, matchall query is created
     *
     * @param string|array|\TestElastica\Query $query Array with all query data inside or a TestElastica\Query object
     *
     * @return int number of documents matching the query
     */
    public function count($query = '');

    /**
     * @param \TestElastica\Query|string $query
     * @param array                      $options
     *
     * @return \TestElastica\Search
     */
    public function createSearch($query = '', $options = null);
}
