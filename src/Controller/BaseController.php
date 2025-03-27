<?php

namespace App\Controller;

use App\DI;
use App\View\View;
use JetBrains\PhpStorm\NoReturn;

abstract class BaseController {

    public static string $HOME = 'home/index';

    public string $defaultAction = 'index';
    protected View $view;
    protected DI $di;

    public function __construct() {
        $this->view = new View();
        $this->di = DI::getInstance();
    }

    public function __toString() {
        return get_class($this);
    }

    #[NoReturn] public function redirect(?string $destination = null, ?string $origin = null, array $params = []): void {
        $destination = $destination ?? self::$HOME;

        $paramsStr = '';
        foreach ($params as $key => $value)
            $paramsStr .= "&$key=$value";

        $location = "?route=$destination" . ($origin ? "&origin=$origin" : '') . $paramsStr;
        header("Location: $location");

        exit();
    }

    #[NoReturn] public function redirectKeepOrigin(?string $destination = null, array $params = []): void {
        $this->redirect($destination ?? null, $_GET['origin'] ?? null, $params);
    }

    #[NoReturn] public function redirectBack(array $params = []): void {
        $this->redirect($_GET['origin'] ?? null, null, $params);
    }

    #[NoReturn] public function authRequired(string $ctrlAct): void {
        if (!$_SESSION['user'])
            $this->redirect('sign/in', $ctrlAct, ['message' => "log in to access $ctrlAct"]);
    }
}