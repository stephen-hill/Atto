<?php

namespace Atto;

class Collection
{
    protected $a = [];

    function __construct(array $a = null)
    {
        if (is_array($a) === true)
        {
            $this->a = $a;
        }
    }

    function get($k)
    {
        return $this->a[$k];
    }

    function add($k, $v)
    {
        $this->a[$k] = $v;

        return $this;
    }

    function all()
    {
        return $this->a;
    }

    function count()
    {
        return count($this->a);
    }

    function remove($k)
    {
        unset($this->a[$k]);

        return $this;
    }
}