<?php
namespace TestElastica\Exception;

use TestElastica\Request;
use TestElastica\Response;

/**
 * Connection exception.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 */
class ConnectionException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var \TestElastica\Request Request object
     */
    protected $_request;

    /**
     * @var \TestElastica\Response Response object
     */
    protected $_response;

    /**
     * Construct Exception.
     *
     * @param string                 $message  Message
     * @param \TestElastica\Request  $request
     * @param \TestElastica\Response $response
     */
    public function __construct($message, Request $request = null, Response $response = null)
    {
        $this->_request = $request;
        $this->_response = $response;

        parent::__construct($message);
    }

    /**
     * Returns request object.
     *
     * @return \TestElastica\Request Request object
     */
    public function getRequest()
    {
        return $this->_request;
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
}
