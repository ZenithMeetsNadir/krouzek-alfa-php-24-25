<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Exception\RecordNotfoundException;
use App\Model\Repository\UserRepository;

class AuthController extends BaseController {

    protected UserRepository $userRepo;

    public function __construct() {
        parent::__construct();
        $this->userRepo = $this->di->userRepositoryFactory();
        $this->defaultAction = 'auth';
    }

    public function formAction(): void {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (!($login && $password))
            $this->redirectKeepOrigin('sign/in', ['message' => 'empty login']);

        try {
            $user = $this->userRepo->findByAnyLogin($login);
            if ($user->getPassword() === $password) {
                $_SESSION['user'] = $user;
                $this->redirectBack();
            }
        } catch (RecordNotfoundException) { }

        $this->redirectKeepOrigin('sign/in', ['message' => 'invalid login or password']);
    }
}