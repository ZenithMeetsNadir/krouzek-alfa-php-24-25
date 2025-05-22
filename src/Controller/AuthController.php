<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Exception\RecordNotfoundException;
use App\Model\Repository\UserRepository;
use JetBrains\PhpStorm\NoReturn;

class AuthController extends BaseController {

    protected UserRepository $userRepo;

    public function __construct() {
        parent::__construct();
        $this->userRepo = $this->di->getSingletonService('userRepository');
    }

    #[NoReturn] public function indexAction(): void {
        $this->redirect->redirect();
    }

    #[NoReturn]
    public function formAction(): void {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (!($login && $password))
            $this->redirect->redirectKeepOrigins('sign/in', params: ['message_id' => 'auth_empty']);

        try {
            $user = $this->userRepo->findByAnyLogin($login);

            if (password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = $user;
                $this->redirect->redirectBack();
            } else if ($user->getPassword() === $password) {
                $_SESSION['user'] = $user;
                $this->redirect->redirectKeepOrigins('credential/updateHash');
            }
        } catch (RecordNotfoundException) { }

        $this->redirect->redirectKeepOrigins('sign/in', params: ['message_id' => 'auth_invalid']);
    }
}