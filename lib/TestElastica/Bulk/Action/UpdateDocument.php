<?php
namespace TestElastica\Bulk\Action;

use TestElastica\Document;
use TestElastica\Script\AbstractScript;

class UpdateDocument extends IndexDocument
{
    /**
     * @var string
     */
    protected $_opType = self::OP_TYPE_UPDATE;

    /**
     * Set the document for this bulk update action.
     *
     * @param \TestElastica\Document $document
     *
     * @return $this
     */
    public function setDocument(Document $document)
    {
        parent::setDocument($document);

        $source = ['doc' => $document->getData()];

        if ($document->getDocAsUpsert()) {
            $source['doc_as_upsert'] = true;
        } elseif ($document->hasUpsert()) {
            $upsert = $document->getUpsert()->getData();

            if (!empty($upsert)) {
                $source['upsert'] = $upsert;
            }
        }

        $this->setSource($source);

        return $this;
    }

    /**
     * @param \TestElastica\Script\AbstractScript $script
     *
     * @return $this
     */
    public function setScript(AbstractScript $script)
    {
        parent::setScript($script);

        // FIXME: can we throw away toArray cast?
        $source = $script->toArray();

        if ($script->hasUpsert()) {
            $upsert = $script->getUpsert()->getData();

            if (!empty($upsert)) {
                $source['upsert'] = $upsert;
            }
        }

        $this->setSource($source);

        return $this;
    }
}
