<?php

namespace App\Controller;

use App\Service\Connection;
use DateTime;
use App\View\View;

class HomeController extends BaseController {

    public function indexAction(): void {
        $this->view->render('home/index');
    }

    public function testAction(): void {
        $connection = new Connection();
        $connection->query('SELECT * FROM user');
    }
}