<?php
namespace Elastica6\Test;

use Elastica6\Exception\NotImplementedException;
use Elastica6\Query\BoolQuery;
use Elastica6\Suggest;
use Elastica6\Suggest\Term;
use Elastica6\Test\Base as BaseTest;

class SuggestTest extends BaseTest
{
    /**
     * Create self test.
     *
     * @group functional
     */
    public function testCreateSelf()
    {
        $suggest = new Suggest();

        $selfSuggest = Suggest::create($suggest);

        $this->assertSame($suggest, $selfSuggest);
    }

    /**
     * Create with suggest test.
     *
     * @group functional
     */
    public function testCreateWithSuggest()
    {
        $suggest1 = new Term('suggest1', '_all');

        $suggest = Suggest::create($suggest1);

        $this->assertTrue($suggest->hasParam('suggestion'));
    }

    /**
     * Create with non suggest test.
     *
     * @group functional
     */
    public function testCreateWithNonSuggest()
    {
        try {
            Suggest::create(new BoolQuery());
            $this->fail();
        } catch (NotImplementedException $e) {
        }
    }
}
