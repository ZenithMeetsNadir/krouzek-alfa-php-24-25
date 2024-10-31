<?php

header('Content-Type: application/json');
header('HTTP/1.1: 200 OK');

echo json_encode([
    'first' => ':3',
    'second' => 'OwO',
]);
