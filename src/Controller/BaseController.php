<?php

namespace App\Controller;

use App\DI;
use App\View\View;
use JetBrains\PhpStorm\NoReturn;

abstract class BaseController {

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

    #[NoReturn] public function redirect(string $destination = 'home/index'): void {
        header("Location: http://localhost/root/$destination");

        exit();
    }
}