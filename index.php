<?php
error_reporting(E_ALL);

require_once 'src/error_catcher.php';
require_once 'src/autoloader.php';


echo "<pre>";
\Joska\Session::authenticate('a', 'a');
var_dump(\Joska\Session::getAuthenticatedUser());

var_dump(\Joska\Session::hasPermission('manage-users'));
echo "</pre>";

$router = new \Joska\Router();

$router
    ->declareRoute('/users/{id?}', 'Joska\Controller\User')

    ->declareRoute('/test', 'Joska\Controller\Test')
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
    ->declareRoute('/image/{path}/{width}/{height}/{extension?}', 'Joska\Controller\Image')
;
