<?php

require '../vendor/autoload.php';
require '../base/db_config.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);

$route = new \Base\Router();
$route->add('/index.php', \App\Controller\Login::class);

$app = new \Base\Application($route);
$app->run();
