<?php

namespace App\Controller;

use DateTime;
use App\Exception\RecordNotfoundException;

class HomeController extends BaseController {

    public function indexAction(): void {
        $this->view->render('home/index');
    }

    public function testAction(): void {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $user = $this->di->userRepositoryFactory()->findById($id);
            } catch (RecordNotFoundException) {
                $this->view->render('error/404');
                return;
            }

            dd($user);
        }


    }
}