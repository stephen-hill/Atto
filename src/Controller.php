<?php

namespace Atto;

class Controller
{
    protected $container;
    
    public function get($containerKey)
    {
        return $this->container->get($containerKey);
    }
    
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
}