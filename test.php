<?php

use Tracy\Debugger;

require "vendor/autoload.php";

Debugger::enable();

function dd(mixed $var) {
    Debugger::dump($var);
}

$potentialJsonData = file_get_contents('temp.json');
dd(json_decode($potentialJsonData, true, flags: JSON_THROW_ON_ERROR));
