<?php

namespace App\Controller;

use App\View\View;

class BaseController {

    public string $defaultAction = "index";
    protected View $view;

    public function __construct() {
        $this->view = new View();
    }
}