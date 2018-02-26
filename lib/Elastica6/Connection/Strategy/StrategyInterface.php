<?php
namespace Elastica6\Connection\Strategy;

/**
 * Description of AbstractStrategy.
 *
 * @author chabior
 */
interface StrategyInterface
{
    /**
     * @param array|\Elastica6\Connection[] $connections
     *
     * @return \Elastica6\Connection
     */
    public function getConnection($connections);
}
