<?php

namespace Atto\ODM;

class Connection
{
    protected $hostname;
    protected $port;
    protected $username;
    protected $password;
    
    public function __construct($hostname, $port, $username, $password)
    {
        $this->setHostname($hostname)
             ->setPort($port)
             ->setUsername($username)
             ->setPassword($password);
    }
    
    public function query($sql, array $parameters = [])
    {
        
    }
}