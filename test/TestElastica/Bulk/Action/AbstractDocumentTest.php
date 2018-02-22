<?php
namespace TestElastica\Test\Bulk\Action;

use TestElastica\Bulk\Action\AbstractDocument;
use TestElastica\Script\Script;
use TestElastica\Test\Base as BaseTest;
use TestElastica\Type;

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
