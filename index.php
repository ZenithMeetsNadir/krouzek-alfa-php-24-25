<?php

use App\DI;
use App\Service\Router;
use Tracy\Debugger;

require "vendor/autoload.php";

Debugger::enable();

function dd(mixed $var): void {
    Debugger::barDump($var);
}

session_start();

$router = DI::getInstance()->getSingletonService('router');
$router->navigateRoute();