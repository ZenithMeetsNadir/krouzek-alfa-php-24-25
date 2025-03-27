<?php

namespace App\Controller;

class SignController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->defaultAction = 'in';
    }

    public function inAction(): void {
        $this->view->render('sign/in', ['message' => $_GET['message']]);
    }

    public function outAction(): void {
        $_SESSION['user'] = null;
        $this->redirectBack();
    }

    public function upAction(): void {
        $this->view->render('sign/up');
    }
}
