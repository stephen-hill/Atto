<?php

use Atto\App;

class AppTest extends PHPUnit_Framework_TestCase
{
    function testApp()
    {
        $a = new App();
        $this->assertInstanceOf('Atto\App', $a);
    }
}