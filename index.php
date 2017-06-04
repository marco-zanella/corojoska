<?php
error_reporting(E_ALL);

require_once 'src/autoloader.php';


$_SERVER = [];
$_SERVER['REQUESTED_URI'] = '/test';
$_SERVER['REQUEST_METHOD'] = 'POST';

$_POST = [];
$_POST['content'] = '<h3>HTML content</h3>';

$router = new \Joska\Router();


echo \Joska\Asset::script('aaa');
exit;

$router
    ->declareRoute('/test', 'Joska\Controller\Test')
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
;
