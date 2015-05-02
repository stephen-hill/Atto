<?php

namespace Atto;

class Request
{
    public $get;
    public $post;
    public $server;
    public $files;

    public function __construct($get = [], $post = [], $server = [], $files = [])
    {
        $this->get = new Collection($get);
        $this->post = new Collection($post);
        $this->server = new Collection($server);
        $this->files = new Collection($files);
    }

    public static function createFromGlobals()
    {
        return new self($_GET, $_POST, $_SERVER, $_FILES);
    }
}