<?php
namespace TestElastica\Exception;

use TestElastica\JSON;
use TestElastica\Request;
use TestElastica\Response;

/**
 * Partial shard failure exception.
 *
 * @author Ian Babrou <ibobrik@gmail.com>
 */
class PartialShardFailureException extends ResponseException
{
    /**
     * Construct Exception.
     *
     * @param \TestElastica\Request  $request
     * @param \TestElastica\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $shardsStatistics = $response->getShardsStatistics();
        $this->message = JSON::stringify($shardsStatistics);
    }
}
