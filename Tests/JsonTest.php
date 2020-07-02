<?php

namespace ArturDoruch\Json\Tests;

use ArturDoruch\Json\Json;
use PHPUnit\Framework\TestCase;

/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */
class JsonTest extends TestCase
{
    /**
     * @expectedException \ArturDoruch\Json\UnexpectedJsonException
     * @expectedExceptionMessage Syntax error
     * @expectedExceptionCode 4
     */
    public function testStringJsonException()
    {
        try {
            new Json('foo');
        } catch (\ArturDoruch\Json\UnexpectedJsonException $exception) {
            // Get decoded invalid JSON.
            $exception->getJson();
            // Get error code.
            $exception->getCode();
        }

    }

    /*
     * @todo What expected result of decoded and encoded should be?
     */
    /*public function testNullJson()
    {
        $json = new Json(null);
    }*/
}
