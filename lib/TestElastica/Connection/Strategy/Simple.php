<?php
namespace TestElastica\Connection\Strategy;

use TestElastica\Exception\ClientException;

/**
 * Description of SimpleStrategy.
 *
 * @author chabior
 */
class Simple implements StrategyInterface
{
    /**
     * @param array|\TestElastica\Connection[] $connections
     *
     * @throws \TestElastica\Exception\ClientException
     *
     * @return \TestElastica\Connection
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
