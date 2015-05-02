<?php

use Atto\JsonResponse;

class JsonResponseTest extends PHPUnit_Framework_TestCase
{
    function testConstructor()
    {
        $response = new JsonResponse();
        
        $this->assertInstanceOf('Atto\Response', $response);
    }
}