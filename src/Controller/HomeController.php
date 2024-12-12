<?php

namespace App\Controller;

use DateTime;
use App\View\View;

class HomeController extends BaseController {

    public function indexAction(): void {
        $this->view->render('home/index');
    }

    public function testAction(): void {
        $this->view->render(
            'home/test',
            [
                'date' => (new DateTime())->format('d.m.Y H:i')
            ]
        );
    }
}