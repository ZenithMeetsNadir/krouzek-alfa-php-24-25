<?php

namespace App\Controller;

class SignController extends BaseController {

    public string $defaultAction = 'in';

    public function inAction(): void {
        $this->renderView(['message' => $_GET['message']]);
    }

    public function outAction(): void {
        $_SESSION['user'] = null;
        $this->redirect->redirectBack();
    }

    public function upAction(): void {
        $this->renderView();
    }
}
