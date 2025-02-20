<?php

namespace App\Controller;

use DateTime;

class HomeController extends BaseController {

    public function indexAction(): void {
        $this->view->render('home/index');
    }

    public function testAction(): void {
        dd($this->di->userRepositoryFactory()->findById(4));
    }
}