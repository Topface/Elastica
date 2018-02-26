<?php
namespace Elastica6\Test\Query;

use Elastica6\Document;
use Elastica6\Index;
use Elastica6\Query\QueryString;
use Elastica6\Test\Base as BaseTest;
use Elastica6\Type;
use Elastica6\Util;

class EscapeStringTest extends BaseTest
{
    /**
     * @group functional
     */
    public function testSearch()
    {
        $index = $this->_createIndex();
        $index->getSettings()->setNumberOfReplicas(0);

        $type = new Type($index, 'helloworld');

        $doc = new Document(1, [
            'email' => 'test@test.com', 'username' => 'test 7/6 123', 'test' => ['2', '3', '5'], ]
        );
        $type->addDocument($doc);

        // Refresh index
        $index->refresh();

        $queryString = new QueryString(Util::escapeTerm('test 7/6'));
        $resultSet = $type->search($queryString);

        $this->assertEquals(1, $resultSet->count());
    }
}
