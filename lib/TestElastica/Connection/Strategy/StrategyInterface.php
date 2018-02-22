<?php
namespace TestElastica\Connection\Strategy;

/**
 * Description of AbstractStrategy.
 *
 * @author chabior
 */
interface StrategyInterface
{
    /**
     * @param array|\TestElastica\Connection[] $connections
     *
     * @return \TestElastica\Connection
     */
    public function getConnection($connections);
}
