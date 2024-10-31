<?php

require "vendor/autoload.php";

function dd(mixed $var) {
    \Tracy\Debugger::dump($var);
}