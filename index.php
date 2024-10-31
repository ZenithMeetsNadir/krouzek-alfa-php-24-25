<?php

require "vendor/autoload.php";

function dd(mixed $var) {
    \Tracy\Debugger::dump($var);
}

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'localhost/root/api.php');

dd(json_decode($response->getBody()->getContents()), true);