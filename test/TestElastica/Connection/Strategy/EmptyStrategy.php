<?php
namespace TestElastica\Test\Connection\Strategy;

use TestElastica\Connection\Strategy\StrategyInterface;

/**
 * Description of EmptyStrategy.
 *
 * @author chabior
 */
class EmptyStrategy implements StrategyInterface
{
    public function getConnection($connections)
    {
        return;
    }
}
