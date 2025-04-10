<?php

namespace App\Controller;

use App\Attribute\RequireAuth;
use App\DI;
use DateTime;
use App\Exception\RecordNotfoundException;

class HomeController extends BaseController {

    public function indexAction(): void {
        $this->renderView();
    }

    public function testAction(): void {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $user = $this->di->getSingletonService('userRepository')->findById($id);
            } catch (RecordNotFoundException) {
                $this->view->render('error/404');
                return;
            }

            dd($user);
        }
    }

    #[RequireAuth]
    public function authreqAction(): void {
        $addressRepo = $this->di->getSingletonService('addressRepo');
        $this->renderView(['address' => $addressRepo->getById(1)]);
    }
}