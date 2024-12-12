<?php

use App\Controller\HomeController;
use App\Controller\LogController;
use App\Exception\ControllerNotFoundException;
use App\Exception\ActionNotFoundException;
use App\View\View;
use Tracy\Debugger;

require "vendor/autoload.php";

Debugger::enable();

function dd(mixed $var) {
    Debugger::dump($var);
}

$defaultController = 'home';

$route = empty($_GET['route']) ? $defaultController : $_GET['route'];

$controllerAction = explode("/", $route);

$controller = empty($controllerAction[0]) ? $defaultController : $controllerAction[0];
$controllerQualfName = "App\Controller\\" .  ucfirst($controller) . "Controller";

if (!class_exists($controllerQualfName)) {
    throw new ControllerNotFoundException(
        "Controller " . $controllerQualfName . " not found.",
        404
    );
}

$controllerInst = new $controllerQualfName();

$action = empty($controllerAction[1]) ? $controllerInst->defaultAction : $controllerAction[1];
$actionQualfName = $action . "Action";

if (!method_exists($controllerInst, $actionQualfName)) {
    throw new ActionNotFoundException(
        "Action " . $actionQualfName . " not found on controller " . $controllerQualfName,
        404
    );
}

$controllerInst->$actionQualfName();