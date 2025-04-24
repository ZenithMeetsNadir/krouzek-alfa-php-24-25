<?php

namespace App\Controller;

use App\Attribute\RequireAuth;
use App\Controller\BaseController;

class ContactController extends BaseController {

    #[RequireAuth]
    public function createFormAction() {
        $this->renderView();
    }
}