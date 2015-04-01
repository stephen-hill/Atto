<?php

namespace Atto;

class Request
{
    var $params;
    var $post;
    var $query;
    var $server;
    var $files;
    var $cookies;
    var $headers;

    function __constuct($array)
    {
        foreach ($array as $k => $v)
        {
            $this->{$k} = $v;
        }
    }
}