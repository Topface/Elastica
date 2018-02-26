<?php
namespace Elastica6\Test\Connection\Strategy;

use Elastica6\Connection\Strategy\StrategyInterface;

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
