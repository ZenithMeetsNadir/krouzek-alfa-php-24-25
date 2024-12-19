<?php

namespace App\Controller;

class LogController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->defaultAction = 'in';
    }

    public function inAction(): void {
        $this->view->render('log/in');
    }

    public function outAction(): void {
        $this->view->render('log/out');
    }

    public function upAction(): void {
        $this->view->render('log/up');
    }
}
