<?php

namespace App\Controller;

use App\Controller\BaseController;

class AuthController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->defaultAction = 'auth';
    }

    public function formAction(): void {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (!($login && $password))
            $this->redirect('sign/in');


    }
}