<?php

namespace App\Controller;

use App\Controller\BaseController;

class ErrorController extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->defaultAction = 'e404';
    }

    public function e404Action() {
        $this->renderView();
    }

    public function e403Action() {
        $this->renderView();
    }
}