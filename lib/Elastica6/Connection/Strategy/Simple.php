<?php
namespace Elastica6\Connection\Strategy;

use Elastica6\Exception\ClientException;

/**
 * Description of SimpleStrategy.
 *
 * @author chabior
 */
class Simple implements StrategyInterface
{
    /**
     * @param array|\Elastica6\Connection[] $connections
     *
     * @throws \Elastica6\Exception\ClientException
     *
     * @return \Elastica6\Connection
     */
    public function getConnection($connections)
    {
        foreach ($connections as $connection) {
            if ($connection->isEnabled()) {
                return $connection;
            }
        }

        throw new ClientException('No enabled connection');
    }
}
