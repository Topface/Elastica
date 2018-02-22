<?php
namespace TestElastica\Connection;

use TestElastica\Client;
use TestElastica\Connection;
use TestElastica\Connection\Strategy\StrategyInterface;
use Exception;

/**
 * Description of ConnectionPool.
 *
 * @author chabior
 */
class ConnectionPool
{
    /**
     * @var array|\TestElastica\Connection[] Connections array
     */
    protected $_connections;

    /**
     * @var \TestElastica\Connection\Strategy\StrategyInterface Strategy for connection
     */
    protected $_strategy;

    /**
     * @var callback Function called on connection fail
     */
    protected $_callback;

    /**
     * @param array                                               $connections
     * @param \TestElastica\Connection\Strategy\StrategyInterface $strategy
     * @param callback                                            $callback
     */
    public function __construct(array $connections, StrategyInterface $strategy, $callback = null)
    {
        $this->_connections = $connections;

        $this->_strategy = $strategy;

        $this->_callback = $callback;
    }

    /**
     * @param \TestElastica\Connection $connection
     *
     * @return $this
     */
    public function addConnection(Connection $connection)
    {
        $this->_connections[] = $connection;

        return $this;
    }

    /**
     * @param array|\TestElastica\Connection[] $connections
     *
     * @return $this
     */
    public function setConnections(array $connections)
    {
        $this->_connections = $connections;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasConnection()
    {
        foreach ($this->_connections as $connection) {
            if ($connection->isEnabled()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getConnections()
    {
        return $this->_connections;
    }

    /**
     * @throws \TestElastica\Exception\ClientException
     *
     * @return \TestElastica\Connection
     */
    public function getConnection()
    {
        return $this->_strategy->getConnection($this->getConnections());
    }

    /**
     * @param \TestElastica\Connection $connection
     * @param \Exception               $e
     * @param Client                   $client
     */
    public function onFail(Connection $connection, Exception $e, Client $client)
    {
        $connection->setEnabled(false);

        if ($this->_callback) {
            call_user_func($this->_callback, $connection, $e, $client);
        }
    }

    /**
     * @return \TestElastica\Connection\Strategy\StrategyInterface
     */
    public function getStrategy()
    {
        return $this->_strategy;
    }
}
