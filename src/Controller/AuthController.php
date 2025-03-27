<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Exception\RecordNotfoundException;
use App\Model\Repository\UserRepository;

class AuthController extends BaseController {

    public string $defaultAction = 'auth';
    protected UserRepository $userRepo;

    public function __construct() {
        parent::__construct();
        $this->userRepo = $this->di->userRepositoryFactory();
    }

    public function formAction(): void {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (!($login && $password))
            $this->redirect->redirectKeepOrigins('sign/in', params: ['message' => 'empty login']);

        try {
            $user = $this->userRepo->findByAnyLogin($login);
            if ($user->getPassword() === $password) {
                $_SESSION['user'] = $user;
                $this->redirect->redirectBack();
            }
        } catch (RecordNotfoundException) { }

        $this->redirect->redirectKeepOrigins('sign/in', params: ['message' => 'invalid login or password']);
    }
}