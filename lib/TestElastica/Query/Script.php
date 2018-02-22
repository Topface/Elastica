<?php
namespace TestElastica\Query;

use TestElastica;

/**
 * Script query.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-script-query.html
 */
class Script extends AbstractQuery
{
    /**
     * Construct script query.
     *
     * @param array|string|\TestElastica\Script\AbstractScript $script OPTIONAL Script
     */
    public function __construct($script = null)
    {
        if ($script) {
            $this->setScript($script);
        }
    }

    /**
     * Sets script object.
     *
     * @param \TestElastica\Script\Script|string|array $script
     *
     * @return $this
     */
    public function setScript($script)
    {
        return $this->setParam('script', TestElastica\Script\Script::create($script));
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $array = parent::toArray();

        if (isset($array['script'])) {
            $array['script'] = $array['script']['script'];
        }

        return $array;
    }
}
