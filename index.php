<?php

use Tracy\Debugger;

require "vendor/autoload.php";
require "Rectangle.php";
require "Square.php";

function dd(mixed $var) {
    Debugger::dump($var);
}

$rect = new Rectangle(5.5, 6);

$sqr = new Square(4);
$sqr->setA(7);

echo $sqr;