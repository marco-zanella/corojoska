<?php
error_reporting(E_ALL);

require_once 'src/autoloader.php';


$_SERVER = [];
$_SERVER['REQUESTED_URI'] = '/post/1';
$_SERVER['REQUEST_METHOD'] = 'POST';

$_POST = [];
$_POST['content'] = '<h3>HTML content</h3>';

$router = new \Joska\Router();

$router
    ->declareRoute('/post/{id}', 'Joska\Controller\Post')
;
