<?php
namespace TestElastica\Index;

use TestElastica\Index as BaseIndex;

/**
 * TestElastica index stats object.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-stats.html
 */
class Stats
{
    /**
     * Response.
     *
     * @var \TestElastica\Response Response object
     */
    protected $_response;

    /**
     * Stats info.
     *
     * @var array Stats info
     */
    protected $_data = [];

    /**
     * Index.
     *
     * @var \TestElastica\Index Index object
     */
    protected $_index;

    /**
     * Construct.
     *
     * @param \TestElastica\Index $index Index object
     */
    public function __construct(BaseIndex $index)
    {
        $this->_index = $index;
        $this->refresh();
    }

    /**
     * Returns the raw stats info.
     *
     * @return array Stats info
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Returns the entry in the data array based on the params.
     * Various params possible.
     *
     * @return mixed Data array entry or null if not found
     */
    public function get()
    {
        $data = $this->getData();

        foreach (func_get_args() as $arg) {
            if (isset($data[$arg])) {
                $data = $data[$arg];
            } else {
                return;
            }
        }

        return $data;
    }

    /**
     * Returns the index object.
     *
     * @return \TestElastica\Index Index object
     */
    public function getIndex()
    {
        return $this->_index;
    }

    /**
     * Returns response object.
     *
     * @return \TestElastica\Response Response object
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * Reloads all status data of this object.
     */
    public function refresh()
    {
        $this->_response = $this->getIndex()->requestEndpoint(new \Elasticsearch\Endpoints\Indices\Stats());
        $this->_data = $this->getResponse()->getData();
    }
}
