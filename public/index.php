<?php

require('../vendor/autoload.php');

$kernal = new HttpKernal();
$request = Request::createFromGlobals();

$response = $kernal->handle($request);
$response->send();
$kernal->terminate($request, $response);
