<?php
namespace Elastica6\Exception\Connection;

use Elastica6\Exception\ConnectionException;
use Elastica6\Request;
use Elastica6\Response;
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
     * @param \Elastica6\Request                   $request
     * @param \Elastica6\Response                  $response
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
