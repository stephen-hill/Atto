<?php

namespace Atto\ODM;

class Manager
{
    protected $connection;
    protected $persist = [];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function persist($document)
    {

    }

    public function flush()
    {

    }
}