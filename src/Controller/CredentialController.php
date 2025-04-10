<?php

namespace App\Controller;

use App\Attribute\RequireAuth;
use App\Controller\BaseController;
use App\Model\Repository\UserRepository;
use JetBrains\PhpStorm\NoReturn;
use Tracy\Debugger;

class CredentialController extends BaseController {

    protected UserRepository $userRepo;

    public function __construct() {
        parent::__construct();
        $this->userRepo = $this->di->getSingletonService('userRepository');
    }

    #[NoReturn] public function indexAction(): void {
        $this->redirect->redirect();
    }

    #[RequireAuth]
    #[NoReturn]
    public function updateHashAction(): void {
        $user = $_SESSION['user'];

        if (!$user)
            $this->redirect->redirectBack();

        $password = $user->getPassword();
        $id = $user->getId();

        $hash = password_hash($password, null);

        $this->userRepo->changePassword($id, $hash);
        $_SESSION['user'] = $this->userRepo->findById($id);

        $this->redirect->redirectBack();
    }
}