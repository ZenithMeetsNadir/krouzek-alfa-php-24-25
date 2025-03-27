<?php

use App\Controller\HomeController;
use App\Controller\SignController;
use App\Exception\ControllerNotFoundException;
use App\Exception\ActionNotFoundException;
use App\Router;
use App\Service\Connection;
use App\View\View;
use Tracy\Debugger;

require "vendor/autoload.php";

Debugger::enable();

function dd(mixed $var): void {
    Debugger::dump($var);
}

session_start();

$router = new Router();
$router->navigateRoute();