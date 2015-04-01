<?php
require('../vendor/autoload.php');

$request = new Atto\Request([
    'post' => $_POST,
    'query' => $_GET,
    'server' => $_SERVER,
    'files' => $_FILES,
    'cookies' => $_COOKIES
]);

(new Atto\App())->run();