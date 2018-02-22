<?php
namespace TestElastica\Test\Query;

use TestElastica\Document;
use TestElastica\Index;
use TestElastica\Query\QueryString;
use TestElastica\Test\Base as BaseTest;
use TestElastica\Type;
use TestElastica\Util;

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
