<?php
namespace Elastica6\Test\Transport;

use Elastica6\Request;
use Elastica6\Transport\AbstractTransport;

class DummyTransport extends AbstractTransport
{
    public function exec(Request $request, array $params)
    {
        // empty
    }
}
