<?php
$controllers = array(
  'pages' => ['home', 'error', 'getAllListTask', 'updateTask'],
  'posts' => ['index'], // bổ sung thêm
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'pages';
  $action = 'error';
}

include_once('controllers/' . $controller . 'Controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();