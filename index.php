<?php
error_reporting(E_ALL);

require_once 'src/error_catcher.php';
require_once 'src/autoloader.php';

$router = new \Joska\Router();

$router
    ->declareRoute('/login', 'Joska\Controller\Session')

    ->declareRoute('/account/{mode?}', 'Joska\Controller\Account')
    ->declareRoute('/my-posts/{id?}/{mode?}', 'Joska\Controller\MyPosts')
    ->declareRoute('/users/{id?}/{mode?}', 'Joska\Controller\User')

    ->declareRoute('/test', 'Joska\Controller\Test')
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
    ->declareRoute('/image/{path}/{width}/{height}/{extension?}', 'Joska\Controller\Image')
;
