<?php
namespace Elastica6\Test\Bulk\Action;

use Elastica6\Bulk\Action\AbstractDocument;
use Elastica6\Script\Script;
use Elastica6\Test\Base as BaseTest;
use Elastica6\Type;

class AbstractDocumentTest extends BaseTest
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The data needs to be a Document or a Script.
     * @group unit
     */
    public function testCreateAbstractDocumentWithInvalidParameter()
    {
        AbstractDocument::create(new \stdClass());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Scripts can only be used with the update operation type.
     * @group unit
     */
    public function testCreateAbstractDocumentWithScript()
    {
        AbstractDocument::create(new Script('foobar'), AbstractDocument::OP_TYPE_CREATE);
    }
}
