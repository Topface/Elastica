<?php
namespace TestElastica\Test;

use TestElastica\JSON;

/**
 * JSONTest.
 *
 * @author Oleg Andreyev <oleg.andreyev@intexsys.lv>
 */
class JSONTest extends \PHPUnit_Framework_TestCase
{
    public function testStringifyMustNotThrowExceptionOnValid()
    {
        JSON::stringify([]);
    }

    /**
     * @expectedException \TestElastica\Exception\JSONParseException
     * @expectedExceptionMessage Inf and NaN cannot be JSON encoded
     */
    public function testStringifyMustThrowExceptionNanOrInf()
    {
        $arr = [NAN, INF];
        JSON::stringify($arr);
    }

    /**
     * @expectedException \TestElastica\Exception\JSONParseException
     * @expectedExceptionMessage Maximum stack depth exceeded
     */
    public function testStringifyMustThrowExceptionMaximumDepth()
    {
        $arr = [[[]]];
        JSON::stringify($arr, 0, 0);
    }
}
