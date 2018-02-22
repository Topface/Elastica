<?php
namespace TestElastica\Test;

use TestElastica\Pipeline;
use TestElastica\Test\Base as BaseTest;

class BasePipeline extends BaseTest
{
    /**
     * Create Pipeline object.
     *
     * @param string $id
     * @param string $description
     *
     * @return Pipeline
     */
    protected function _createPipeline(string $id = null, string $description = '')
    {
        if (is_null($id)) {
            $id = preg_replace('/[^a-z]/i', '', strtolower(get_called_class()).uniqid());
        }

        $pipeline = new Pipeline($this->_getClient());
        $pipeline->setId($id);
        $pipeline->setDescription($description);

        return $pipeline;
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->_createPipeline()->deletePipeline('*');
        parent::tearDown();
    }
}
