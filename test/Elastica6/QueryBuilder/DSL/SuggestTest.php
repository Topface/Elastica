<?php
namespace Elastica6\Test\QueryBuilder\DSL;

use Elastica6\QueryBuilder\DSL;
use Elastica6\Suggest;

class SuggestTest extends AbstractDSLTest
{
    /**
     * @group unit
     */
    public function testType()
    {
        $suggestDSL = new DSL\Suggest();

        $this->assertInstanceOf(DSL::class, $suggestDSL);
        $this->assertEquals(DSL::TYPE_SUGGEST, $suggestDSL->getType());
    }

    /**
     * @group unit
     */
    public function testInterface()
    {
        $suggestDSL = new DSL\Suggest();

        $this->_assertImplemented($suggestDSL, 'completion', Suggest\Completion::class, ['name', 'field']);
        $this->_assertImplemented($suggestDSL, 'phrase', Suggest\Phrase::class, ['name', 'field']);
        $this->_assertImplemented($suggestDSL, 'term', Suggest\Term::class, ['name', 'field']);

        $this->_assertNotImplemented($suggestDSL, 'context', []);
    }
}
