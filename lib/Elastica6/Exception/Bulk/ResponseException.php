<?php
namespace Elastica6\Exception\Bulk;

use Elastica6\Bulk\ResponseSet;
use Elastica6\Exception\Bulk\Response\ActionException;
use Elastica6\Exception\BulkException;

/**
 * Bulk Response exception.
 */
class ResponseException extends BulkException
{
    /**
     * @var \Elastica6\Bulk\ResponseSet ResponseSet object
     */
    protected $_responseSet;

    /**
     * @var \Elastica6\Exception\Bulk\Response\ActionException[]
     */
    protected $_actionExceptions = [];

    /**
     * Construct Exception.
     *
     * @param \Elastica6\Bulk\ResponseSet $responseSet
     */
    public function __construct(ResponseSet $responseSet)
    {
        $this->_init($responseSet);

        $message = 'Error in one or more bulk request actions:'.PHP_EOL.PHP_EOL;
        $message .= $this->getActionExceptionsAsString();

        parent::__construct($message);
    }

    /**
     * @param \Elastica6\Bulk\ResponseSet $responseSet
     */
    protected function _init(ResponseSet $responseSet)
    {
        $this->_responseSet = $responseSet;

        foreach ($responseSet->getBulkResponses() as $bulkResponse) {
            if ($bulkResponse->hasError()) {
                $this->_actionExceptions[] = new ActionException($bulkResponse);
            }
        }
    }

    /**
     * Returns bulk response set object.
     *
     * @return \Elastica6\Bulk\ResponseSet
     */
    public function getResponseSet()
    {
        return $this->_responseSet;
    }

    /**
     * Returns array of failed actions.
     *
     * @return array Array of failed actions
     */
    public function getFailures()
    {
        $errors = [];

        foreach ($this->getActionExceptions() as $actionException) {
            $errors[] = $actionException->getMessage();
        }

        return $errors;
    }

    /**
     * @return \Elastica6\Exception\Bulk\Response\ActionException[]
     */
    public function getActionExceptions()
    {
        return $this->_actionExceptions;
    }

    /**
     * @return string
     */
    public function getActionExceptionsAsString()
    {
        $message = '';
        foreach ($this->getActionExceptions() as $actionException) {
            $message .= $actionException->getMessage().PHP_EOL;
        }

        return $message;
    }
}
