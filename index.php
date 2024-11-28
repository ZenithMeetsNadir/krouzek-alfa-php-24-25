<?php

use App\Controller\HomeController;
use Tracy\Debugger;

require "vendor/autoload.php";

function dd(mixed $var) {
    Debugger::dump($var);
}

$controller = new HomeController();