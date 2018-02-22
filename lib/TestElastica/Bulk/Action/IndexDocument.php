<?php
namespace TestElastica\Bulk\Action;

use TestElastica\AbstractUpdateAction;
use TestElastica\Document;

class IndexDocument extends AbstractDocument
{
    /**
     * @var string
     */
    protected $_opType = self::OP_TYPE_INDEX;

    /**
     * @param \TestElastica\Document $document
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
     * @param \TestElastica\AbstractUpdateAction $action
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
