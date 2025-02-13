<?php

namespace App\Controller;

use App\DI;
use App\View\View;

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
}