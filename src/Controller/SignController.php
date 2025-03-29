<?php

namespace App\Controller;

class SignController extends BaseController {

    public string $defaultAction = 'in';

    public function inAction(): void {
        $this->renderView();
    }

    public function outAction(): void {
        $_SESSION['user'] = null;
        $this->redirect->redirectBack();
    }

    public function upAction(): void {
        $this->renderView();
    }
}
