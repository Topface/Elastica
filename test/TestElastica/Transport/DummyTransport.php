<?php
namespace TestElastica\Test\Transport;

use TestElastica\Request;
use TestElastica\Transport\AbstractTransport;

class DummyTransport extends AbstractTransport
{
    public function exec(Request $request, array $params)
    {
        // empty
    }
}
