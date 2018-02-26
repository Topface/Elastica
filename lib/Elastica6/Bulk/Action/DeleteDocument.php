<?php
namespace Elastica6\Bulk\Action;

use Elastica6\AbstractUpdateAction;

class DeleteDocument extends AbstractDocument
{
    /**
     * @var string
     */
    protected $_opType = self::OP_TYPE_DELETE;

    /**
     * @param \Elastica6\AbstractUpdateAction $action
     *
     * @return array
     */
    protected function _getMetadata(AbstractUpdateAction $action)
    {
        $params = [
            'index',
            'type',
            'id',
            'version',
            'version_type',
            'routing',
            'parent',
        ];
        $metadata = $action->getOptions($params, true);

        return $metadata;
    }
}
