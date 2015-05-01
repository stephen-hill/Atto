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
        $container = $container->setFactory('hash_time_factory', function($c)
        {
            return hash($c->get('hash_algo'), (string)microtime(true));
        });

        $timeA = $container->get('hash_time_factory');
        $timeB = $container->get('hash_time_factory');

        $this->assertNotSame($timeA, $timeB);

        // Service
        $container = $container->setService('hash_time_service', function($c)
        {
            return hash($c->get('hash_algo'), (string)microtime(true));
        });

        $timeC = $container->get('hash_time_service');
        sleep(1);
        $timeD = $container->get('hash_time_service');

        $this->assertSame($timeC, $timeD);
    }
}
