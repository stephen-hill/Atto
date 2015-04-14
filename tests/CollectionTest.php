<?php

use Atto\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    function testCollection()
    {
        $c = new Collection();
        $this->assertInstanceOf('Atto\Collection', $c);

        $c = new Collection(['r' => 'Red', 'g' => 'Green', 'b' => 'Blue']);
        $this->assertSame('Red', $c->get('r'));
        $this->assertSame('Green', $c->get('g'));
        $this->assertSame('Blue', $c->get('b'));

        $c->add('y', 'Yellow');
        $this->assertSame('Yellow', $c->get('y'));

        $this->assertSame(4, $c->count());
        $this->assertSame(
            ['r' => 'Red', 'g' => 'Green', 'b' => 'Blue', 'y' => 'Yellow'],
            $c->all()
        );

        $c->remove('b');
        $this->assertSame(3, $c->count());
        $this->assertSame(
            ['r' => 'Red', 'g' => 'Green', 'y' => 'Yellow'],
            $c->all()
        );

        $c->clear();
        $this->assertSame([], $c->all());
    }
}