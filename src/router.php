<?php

namespace App;

function controllerFactory(): mixed {
    $route = $_GET['route'] ?? "home";

    $controllerAction = explode("/", $route);
    $controller = $controllerAction[0];

    return new ("App\Controller\\" . ucfirst($controller) . "Controller");
}