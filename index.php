<?php
error_reporting(E_ALL);

require_once 'src/error_catcher.php';
require_once 'src/autoloader.php';

$router = new \Joska\Router();

$router
// Front end
->declareRoute('/$', 'Joska\Controller\Home')
->declareRoute('/blog/{id?}', 'Joska\Controller\Blog')
->declareRoute('/calendario/{id?}', 'Joska\Controller\Events')
->declareRoute('/biografia', 'Joska\Controller\Biography')
->declareRoute('/contatti', 'Joska\Controller\Contacts')
->declareRoute('/cerca', 'Joska\Controller\Search')
->declareRoute('/login', 'Joska\Controller\Session')
->declareRoute('/easter-egg', 'Joska\Controller\EasterEgg')

// Backend
->declareRoute('/account/{mode?}', 'Joska\Controller\Account')
->declareRoute('/my-posts/{id?}/{mode?}', 'Joska\Controller\MyPosts')
->declareRoute('/manage-posts/{id?}/{mode?}', 'Joska\Controller\ManagePosts')
->declareRoute('/manage-events/{id?}/{mode?}', 'Joska\Controller\ManageEvents')
->declareRoute('/users/{id?}/{mode?}', 'Joska\Controller\User')

// Miscellaneous and utitilies
->declareRoute('/image/{path}/{width}/{height}/{extension?}', 'Joska\Controller\Image')
->declareRoute('/sitemap', 'Joska\Controller\Sitemap')
->declareRoute('/error/{message?}', 'Joska\Controller\Error')
->defaultRoute('Joska\Controller\NotFound')
;