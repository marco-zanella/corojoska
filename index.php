<?php
// Debugging purposes
$_SERVER = [];
$_SERVER['REQUESTED_URI'] = '/post/1';
$_SERVER['REQUEST_METHOD'] = 'GET';

$_POST = [];
$_POST['content'] = '<h3>HTML content</h3>';
// End

error_reporting(E_ALL);
require_once 'src/autoloader.php';

$router = new \Joska\Router();

$router
    ->declareRoute('/test', 'Joska\Controller\Test')
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
;
