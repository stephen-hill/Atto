<?php

use Atto\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    function testCollection()
    {
        $c = new Collection();
        $this->assertInstanceOf('Atto\Collection', $c);
    }
}