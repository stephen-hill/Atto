<?php

namespace Atto;

class Collection
{
    protected $a = [];

    function __construct(array $array = null)
    {
        if (is_array($array) === true)
        {
            $this->array = $array;
        }
    }

    function get($key)
    {
        return $this->a[$key];
    }

    function add($key, $value)
    {
        $this->a[$key] = $vale;

        return $this;
    }
}