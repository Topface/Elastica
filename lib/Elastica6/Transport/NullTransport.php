<?php
namespace Elastica6\Transport;

use Elastica6\JSON;
use Elastica6\Request;
use Elastica6\Response;

/**
 * Elastica6 Null Transport object.
 *
 * This is used in case you just need a test transport that doesn't do any connection to an elasticsearch
 * host but still returns a valid response object
 *
 * @author James Boehmer <james.boehmer@jamesboehmer.com>
 */
class NullTransport extends AbstractTransport
{
    /**
     * Null transport.
     *
     * @param \Elastica6\Request $request
     * @param array                 $params  Hostname, port, path, ...
     *
     * @return \Elastica6\Response Response empty object
     */
    public function exec(Request $request, array $params)
    {
        $response = [
            'took' => 0,
            'timed_out' => false,
            '_shards' => [
                'total' => 0,
                'successful' => 0,
                'failed' => 0,
            ],
            'hits' => [
                'total' => 0,
                'max_score' => null,
                'hits' => [],
            ],
            'params' => $params,
        ];

        return new Response(JSON::stringify($response));
    }
}
