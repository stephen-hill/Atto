<?php

use Atto\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    protected $path = __DIR__ . '/config.json';

    function testConstructor()
    {
        // Constructor
        $c = new Config($this->path);
        $this->assertInstanceOf('Atto\Config', $c);
    }

    function testSimpleGet()
    {
        // Get
        $c = new Config($this->path);
        $this->assertEquals('Atto', $c->get('name'));
    }

    function testSimpleDefault()
    {
        // Get
        $c = new Config($this->path);
        $this->assertEquals('John', $c->get('thiskeydoesnotexist', 'John'));
    }
}