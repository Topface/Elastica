<?php
namespace TestElastica\Exception\Connection;

use TestElastica\Exception\ConnectionException;
use TestElastica\Request;
use TestElastica\Response;
use GuzzleHttp\Exception\TransferException;

/**
 * Transport exception.
 *
 * @author Milan Magudia <milan@magudia.com>
 */
class GuzzleException extends ConnectionException
{
    /**
     * @var TransferException
     */
    protected $_guzzleException;

    /**
     * @param \GuzzleHttp\Exception\TransferException $guzzleException
     * @param \TestElastica\Request                   $request
     * @param \TestElastica\Response                  $response
     */
    public function __construct(TransferException $guzzleException, Request $request = null, Response $response = null)
    {
        $this->_guzzleException = $guzzleException;
        $message = $this->getErrorMessage($this->getGuzzleException());
        parent::__construct($message, $request, $response);
    }

    /**
     * @param \GuzzleHttp\Exception\TransferException $guzzleException
     *
     * @return string
     */
    public function getErrorMessage(TransferException $guzzleException)
    {
        return $guzzleException->getMessage();
    }

    /**
     * @return TransferException
     */
    public function getGuzzleException()
    {
        return $this->_guzzleException;
    }
}
