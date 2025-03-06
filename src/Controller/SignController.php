<?php

namespace App\Controller;

class SignController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->defaultAction = 'in';
    }

    public function inAction(): void {
        $this->view->render('sign/in');
    }

    public function outAction(): void {
        $this->view->render('sign/out');
    }

    public function upAction(): void {
        $this->view->render('sign/up');
    }
}
