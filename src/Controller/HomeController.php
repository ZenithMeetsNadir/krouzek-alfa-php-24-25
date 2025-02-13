<?php

namespace App\Controller;

use DateTime;

class HomeController extends BaseController {

    public function indexAction(): void {
        $this->view->render('home/index');
    }

    public function testAction(): void {
        $connection = $this->di->getSingletonService('connection');
        $userQuery = $connection->query('SELECT * FROM user');

    }
}