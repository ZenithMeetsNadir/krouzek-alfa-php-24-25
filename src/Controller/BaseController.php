<?php

namespace App\Controller;

use App\View\View;

abstract class BaseController {

    public string $defaultAction = 'index';
    protected View $view;

    public function __construct() {
        $this->view = new View();
    }

    public function __toString() {
        return get_class($this);
    }
}