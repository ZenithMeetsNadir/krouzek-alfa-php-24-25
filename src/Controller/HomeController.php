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

    }

    #[RequireAuth]
    public function authreqAction(): void {
        $addrId = $_GET['addr_id'] ?? null;
        $contactId = $_GET['contact_id'] ?? null;

        $data = [];

        if ($addrId) {
            $addressRepo = $this->di->getSingletonService('addressRepository');
            $data['address'] = $addressRepo->findById($addrId);
        }
        if ($contactId) {
            $contactRepo = $this->di->getSingletonService('contactRepository');
            $data['contact'] = $contactRepo->findById($contactId);
        }

        $this->renderView($data);
    }
}