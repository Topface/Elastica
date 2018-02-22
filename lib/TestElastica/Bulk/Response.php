<?php
namespace TestElastica\Bulk;

use TestElastica\Response as BaseResponse;

class Response extends BaseResponse
{
    /**
     * @var \TestElastica\Bulk\Action
     */
    protected $_action;

    /**
     * @var string
     */
    protected $_opType;

    /**
     * @param array|string              $responseData
     * @param \TestElastica\Bulk\Action $action
     * @param string                    $opType
     */
    public function __construct($responseData, Action $action, $opType)
    {
        parent::__construct($responseData);

        $this->_action = $action;
        $this->_opType = $opType;
    }

    /**
     * @return \TestElastica\Bulk\Action
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * @return string
     */
    public function getOpType()
    {
        return $this->_opType;
    }
}
