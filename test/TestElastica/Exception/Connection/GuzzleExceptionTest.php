<?php
namespace TestElastica\Test\Exception\Connection;

use TestElastica\Test\Exception\AbstractExceptionTest;

class GuzzleExceptionTest extends AbstractExceptionTest
{
    public static function setUpBeforeClass()
    {
        if (!class_exists('GuzzleHttp\\Client')) {
            self::markTestSkipped('guzzlehttp/guzzle package should be installed to run guzzle transport tests');
        }
    }
}
