<?php
error_reporting(E_ALL);

require_once 'src/error_catcher.php';
require_once 'src/autoloader.php';

$router = new \Joska\Router();

$router
// Front end
->declareRoute('/', 'Joska\Controller\Home')
->declareRoute('/login', 'Joska\Controller\Session')

// Backend
->declareRoute('/account/{mode?}', 'Joska\Controller\Account')
->declareRoute('/my-posts/{id?}/{mode?}', 'Joska\Controller\MyPosts')
->declareRoute('/manage-posts/{id?}/{mode?}', 'Joska\Controller\ManagePosts')
->declareRoute('/manage-events/{id?}/{mode?}', 'Joska\Controller\ManageEvents')
->declareRoute('/users/{id?}/{mode?}', 'Joska\Controller\User')

// Miscellaneous and utitilies
->declareRoute('/image/{path}/{width}/{height}/{extension?}', 'Joska\Controller\Image')
;
