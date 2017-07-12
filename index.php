<?php
// Debugging purposes
$_SERVER = [];
$_SERVER['REQUEST_URI'] = '/image/' . urlencode('http://www.cssauthor.com/wp-content/uploads/2014/09/Free-Mockup-PSD1.jpg') . '/640/480/png';
$_SERVER['REQUEST_METHOD'] = 'GET';

$_POST = [];
$_POST['content'] = '<h3>HTML content</h3>';
// End

error_reporting(E_ALL);
require_once 'src/error_catcher.php';
require_once 'src/autoloader.php';



trigger_error('error msg');





$router = new \Joska\Router();


$router
    ->declareRoute('/test', 'Joska\Controller\Test')
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
    ->declareRoute('/image/{path}/{width}/{height}/{extension?}', 'Joska\Controller\Image')
;
