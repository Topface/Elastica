<?php
namespace Elastica6\Bulk\Action;

use Elastica6\AbstractUpdateAction;
use Elastica6\Document;

class IndexDocument extends AbstractDocument
{
    /**
     * @var string
     */
    protected $_opType = self::OP_TYPE_INDEX;

    /**
     * @param \Elastica6\Document $document
     *
     * @return $this
     */
    public function setDocument(Document $document)
    {
        parent::setDocument($document);

        $this->setSource($document->getData());

        return $this;
    }

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
            'retry_on_conflict',
        ];

        $metadata = $action->getOptions($params, true);

        return $metadata;
    }
}
