<?php
namespace Elastica6\Exception;

use Elastica6\Request;
use Elastica6\Response;

/**
 * Connection exception.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 */
class ConnectionException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var \Elastica6\Request Request object
     */
    protected $_request;

    /**
     * @var \Elastica6\Response Response object
     */
    protected $_response;

    /**
     * Construct Exception.
     *
     * @param string                 $message  Message
     * @param \Elastica6\Request  $request
     * @param \Elastica6\Response $response
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
     * @return \Elastica6\Request Request object
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Returns response object.
     *
     * @return \Elastica6\Response Response object
     */
    public function getResponse()
    {
        return $this->_response;
    }
}
