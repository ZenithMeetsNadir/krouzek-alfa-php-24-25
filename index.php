<?php

use App\Controller\HomeController;
use App\Controller\LogController;
use Tracy\Debugger;

require "vendor/autoload.php";

function dd(mixed $var) {
    Debugger::dump($var);
}

$route = $_GET['route'] ?? "home";

$controllerAction = explode("/", $route);
$controller = $controllerAction[0];

$controllerInst = new ("App\Controller\\" . ucfirst($controller) . "Controller");

if (!isset($controllerAction[1]))
    $action = $controllerInst->defaultAction;
else
    $action = $controllerAction[1];


$controllerInst->{$action . "Action"}();