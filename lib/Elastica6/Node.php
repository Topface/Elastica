<?php
namespace Elastica6;

use Elastica6\Node\Info;
use Elastica6\Node\Stats;

/**
 * Elastica6 cluster node object.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 */
class Node
{
    /**
     * Client.
     *
     * @var \Elastica6\Client
     */
    protected $_client;

    /**
     * @var string Unique node id
     */
    protected $_id;

    /**
     * Node name.
     *
     * @var string Node name
     */
    protected $_name;

    /**
     * Node stats.
     *
     * @var \Elastica6\Node\Stats|null Node Stats
     */
    protected $_stats;

    /**
     * Node info.
     *
     * @var \Elastica6\Node\Info|null Node info
     */
    protected $_info;

    /**
     * Create a new node object.
     *
     * @param string               $id     Node id or name
     * @param \Elastica6\Client $client Node object
     */
    public function __construct($id, Client $client)
    {
        $this->_client = $client;
        $this->setId($id);
    }

    /**
     * @return string Unique node id. Can also be name if id not exists.
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $id Node id
     *
     * @return $this Refreshed object
     */
    public function setId($id)
    {
        $this->_id = $id;

        return $this->refresh();
    }

    /**
     * Get the name of the node.
     *
     * @return string Node name
     */
    public function getName()
    {
        if (empty($this->_name)) {
            $this->_name = $this->getInfo()->getName();
        }

        return $this->_name;
    }

    /**
     * Returns the current client object.
     *
     * @return \Elastica6\Client Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Return stats object of the current node.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/cluster-nodes-stats.html
     *
     * @return \Elastica6\Node\Stats Node stats
     */
    public function getStats()
    {
        if (!$this->_stats) {
            $this->_stats = new Stats($this);
        }

        return $this->_stats;
    }

    /**
     * Return info object of the current node.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/cluster-nodes-info.html
     *
     * @return \Elastica6\Node\Info Node info object
     */
    public function getInfo()
    {
        if (!$this->_info) {
            $this->_info = new Info($this);
        }

        return $this->_info;
    }

    /**
     * Refreshes all node information.
     *
     * This should be called after updating a node to refresh all information
     */
    public function refresh()
    {
        $this->_stats = null;
        $this->_info = null;
    }
}
