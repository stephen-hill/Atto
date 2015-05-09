<?php

use Atto\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    protected $config;
    protected $path;
    
    public function setUp()
    {
        $this->path = __DIR__ . '/config.json';
        $this->config = new Config($this->path);
    }

    public function testInstanceType()
    {
        $c = $this->config;
        $this->assertInstanceOf('Atto\Config', $c);
    }

    public function testSimpleGet()
    {
        $c = $this->config;
        $this->assertEquals('Atto', $c->get('name'));
    }

    public function testSimpleDefault()
    {
        $c = $this->config;
        $this->assertEquals('John', $c->get('keynotfound', 'John'));
    }
    
    public function testSegmentedKey()
    {
        $c = $this->config;
        $this->assertEquals('Lou', $c->get('nicknames.lhill'));
        $this->assertEquals('Stephen Hill', $c->get('users.shill.name'));
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionCode 1
     */
    public function testSimpleKeyNotFound()
    {
        $c = $this->config;
        $c->get('keynotfound');
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionCode 1
     */
    public function testSegmentedKeyNotFound()
    {
        $c = $this->config;
        $c->get('key.not.found');
    }
    
    public function testUtf8()
    {
        $c = $this->config;
        $this->assertEquals('kosme', $c->get('utf-8.κόσμε'));
        $this->assertEquals('κόσμε', $c->get('utf-8.kosme'));
    }
}