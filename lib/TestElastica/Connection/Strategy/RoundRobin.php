<?php
namespace TestElastica\Connection\Strategy;

/**
 * Description of RoundRobin.
 *
 * @author chabior
 */
class RoundRobin extends Simple
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
        shuffle($connections);

        return parent::getConnection($connections);
    }
}
