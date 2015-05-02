<?php

use Atto\Container;

class ContainerTest extends PHPUnit_Framework_TestCase
{
    function testContainer()
    {
        $container = new Container();
        $this->assertInstanceOf('Atto\Container', $container);

        // Parameters
        $container = $container->setParameter('hash_algo', 'sha256');
        $this->assertInstanceOf('Atto\Container', $container);
        $this->assertSame('sha256', $container->get('hash_algo'));

        // Factory
        $container = $container->setFactory('hash_rand_factory', function($c)
        {
            return hash($c->get('hash_algo'), (string)mt_rand());
        });

        $randA = $container->get('hash_rand_factory');
        $randB = $container->get('hash_rand_factory');

        $this->assertNotSame($randA, $randB);

        // Service
        $container = $container->setService('hash_rand_service', function($c)
        {
            return hash($c->get('hash_algo'), (string)mt_rand());
        });

        $randC = $container->get('hash_rand_service');
        $randD = $container->get('hash_rand_service');

        $this->assertSame($randC, $randD);
    }
}
