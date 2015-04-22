<?php

require('../vendor/autoload.php');

$kernal = new HttpKernal();
$request = Request::createFromGlobals();

$app = new App($kernal, $request);
$app->run();