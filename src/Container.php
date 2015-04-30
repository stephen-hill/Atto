<?php

namespace Atto;

use InvalidArgumentException;

class Container
{
    protected $values = [];
    protected $keys = [];
    protected $factories = [];
    protected $services = [];

    public function get($key)
    {
        if (isset($this->values[$key]) === false)
        {
            throw new InvalidArgumentException("Key {$key} is not defined.");
        }

        if (isset($this->factories[$key]) === true)
        {
            return $this->values[$key]($this);
        }

        if (isset($this->services[$key]) === true)
        {
            $this->values[$key] = $this->values[$key]($this);
            unset($this->services[$key]);
        }

        return $this->values[$key];
    }

    public function setParameter($key, $value)
    {
        $this->values[$key] = $value;
        $this->keys[$key] = true;

        return $this;
    }

    public function setService($key, callable $callable)
    {
        $this->setParameter($key, $callable);

        $this->services[$key] = true;

        return $this;
    }

    public function setFactory($key, $callable)
    {
        $this->setParameter($key, $callable);

        $this->factories[$key] = true;

        return $this;
    }
}