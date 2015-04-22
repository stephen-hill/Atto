<?php

namespace Atto;

class Request
{
    public $get;
    public $post;
    public $server;
    public $files;
    public $cookies;

    public function __construct($get = [], $post = [], $server = [], $files = [], $cookies = [])
    {
        $this->get = new Collection($get);
        $this->post = new Collection($post);
        $this->server = new Collection($server);
        $this->files = new Collection($files);
        $this->cookies = new Collection($cookies);
    }

    public static function createFromGlobals()
    {
        return new self($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }
}