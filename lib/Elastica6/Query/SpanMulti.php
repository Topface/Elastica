<?php
namespace Elastica6\Query;

use Elastica6\Exception\InvalidException;

/**
 * SpanMulti query.
 *
 * @author Marek Hernik <marek.hernik@gmail.com>
 * @author Alessandro Chitolina <alekitto@gmail.com>
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-span-multi-term-query.html
 */
class SpanMulti extends AbstractSpanQuery
{
    /**
     * Constructs a SpanMulti query object.
     *
     * @param \Elastica6\Query\AbstractQuery|array $match OPTIONAL
     */
    public function __construct($match = null)
    {
        if (null !== $match) {
            $this->setMatch($match);
        }
    }

    /**
     * Set the query to be wrapped into the span multi query.
     *
     * @param \Elastica6\Query\AbstractQuery|array $args Matching query
     *
     * @return $this
     */
    public function setMatch($args)
    {
        return $this->_setQuery('match', $args);
    }

    /**
     * Sets a query to the current object.
     *
     * @param string                                  $type Query type
     * @param \Elastica6\Query\AbstractQuery|array $args Query
     *
     * @throws \Elastica6\Exception\InvalidException If not valid query
     *
     * @return $this
     */
    protected function _setQuery($type, $args)
    {
        if (!is_array($args) && !($args instanceof AbstractQuery)) {
            throw new InvalidException('Invalid parameter. Has to be array or instance of Elastica6\Query\AbstractQuery');
        }

        return $this->setParam($type, $args);
    }
}
