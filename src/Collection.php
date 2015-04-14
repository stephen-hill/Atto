<?php

namespace Atto;

class Collection
{
    protected $items = [];

    function __construct(array $items = null)
    {
        if (is_array($items) === true)
        {
            $this->items = $items;
        }
    }

    function add($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    function all()
    {
        return $this->items;
    }

    function clear()
    {
        $this->items = [];

        return $this;
    }

    function count()
    {
        return count($this->items);
    }

    function get($key)
    {
        return $this->items[$key];
    }

    function remove($key)
    {
        unset($this->items[$key]);

        return $this;
    }
}