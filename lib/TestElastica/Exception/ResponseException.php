<?php
namespace TestElastica\Exception;

use TestElastica\Request;
use TestElastica\Response;

/**
 * Response exception.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 */
class ResponseException extends \RuntimeException implements ExceptionInterface
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
     * @param \TestElastica\Request  $request
     * @param \TestElastica\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->_request = $request;
        $this->_response = $response;
        parent::__construct($response->getErrorMessage());
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

    /**
     * Returns elasticsearch exception.
     *
     * @return ElasticsearchException
     */
    public function getElasticsearchException()
    {
        $response = $this->getResponse();

        return new ElasticsearchException($response->getStatus(), $response->getErrorMessage());
    }
}
