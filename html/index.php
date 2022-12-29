<?php

require '../vendor/autoload.php';
require '../base/db_config.php';
require '../base/eloquent.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);

$route = new \Base\Router();
$route->add('/index.php', \App\Controller\Login::class);
$route->add('/index.php/logout', \App\Controller\Login::class, 'logout');
$route->add('/index.php/admin/users', \App\Controller\Admin\Users::class);
$route->add('/index.php/admin/updateUser', \App\Controller\Admin\Users::class, 'updateUser');
$route->add('/index.php/admin/deleteUser', \App\Controller\Admin\Users::class, 'deleteUser');
$route->add('/index.php/admin/addUser', \App\Controller\Admin\Users::class, 'addUser');

$app = new \Base\Application($route);
$app->run();
