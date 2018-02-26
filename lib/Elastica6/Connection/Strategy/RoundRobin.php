<?php
namespace Elastica6\Connection\Strategy;

/**
 * Description of RoundRobin.
 *
 * @author chabior
 */
class RoundRobin extends Simple
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
        shuffle($connections);

        return parent::getConnection($connections);
    }
}
