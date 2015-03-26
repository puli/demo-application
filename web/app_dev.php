<?php

use Puli\DemoApplication\DemoApplication;

require_once __DIR__.'/../vendor/autoload.php';

$app = new DemoApplication();
$app['debug'] = true;
$app->run();
