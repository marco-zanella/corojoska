<?php
error_reporting(E_ALL);

require_once 'src/error_catcher.php';
require_once 'src/autoloader.php';

$router = new \Joska\Router();

$router
    ->declareRoute('/users/{id?}', 'Joska\Controller\User')

    ->declareRoute('/test', 'Joska\Controller\Test')
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
    ->declareRoute('/image/{path}/{width}/{height}/{extension?}', 'Joska\Controller\Image')
;
