<?php

use Atto\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    function testCollection()
    {
        // Constructor
        $c = new Collection();
        $this->assertInstanceOf('Atto\Collection', $c);
        $this->assertSame([], $c->all());

        // Get
        $c = new Collection(['r' => 'Red', 'g' => 'Green', 'b' => 'Blue']);
        $this->assertSame('Red', $c->get('r'));
        $this->assertSame('Green', $c->get('g'));
        $this->assertSame('Blue', $c->get('b'));

        // Add
        $c->add('y', 'Yellow');
        $this->assertSame('Yellow', $c->get('y'));

        // Count
        $this->assertSame(4, $c->count());
        $this->assertSame(
            ['r' => 'Red', 'g' => 'Green', 'b' => 'Blue', 'y' => 'Yellow'],
            $c->all()
        );

        // Remove
        $c->remove('b');
        $this->assertSame(3, $c->count());
        $this->assertSame(
            ['r' => 'Red', 'g' => 'Green', 'y' => 'Yellow'],
            $c->all()
        );

        // Has
        $this->assertTrue($c->has('r'));
        $this->assertFalse($c->has('z'));

        // Contains
        $this->assertTrue($c->contains('Red'));
        $this->assertFalse($c->contains('Zed'));

        // Clear
        $c->clear();
        $this->assertSame([], $c->all());
    }
}