<?php

namespace App\Controller;

use App\Attribute\RequireAuth;
use App\Controller\BaseController;
use App\Model\Entity\Contact;
use App\Model\Repository\ContactRepository;
use JetBrains\PhpStorm\NoReturn;

class ContactController extends BaseController {

    protected $contactRepo;

    public function __construct() {
        parent::__construct();

        $this->defaultAction = 'list';
        $this->contactRepo = $this->di->getSingletonService('contactRepository');
    }

    #[RequireAuth]
    public function createFormAction() {
        $this->renderView();
    }

    #[RequireAuth]
    #[NoReturn]
    public function createAction() {
        $contact = $this->di->contactFactory();

        $contact
            ->setFirstName($_POST['firstName'])
            ->setLastName($_POST['lastName'])
            ->setEmail($_POST['email'])
            ->setPhone($_POST['phone'])
            ->setBirthdate($_POST['birthdate'])
            ->setNote($_POST['note'])
            ->setUserId($_SESSION['user']->getId());

        $this->contactRepo->save($contact);
    }

    #[RequireAuth]
    public function editFormAction() {
        $contact = $this->contactRepo->findById($_GET['id']);

        $this->renderView();
    }

    #[RequireAuth]
    public function listAction() {
        $contacts = $this->contactRepo->findByUserId($_SESSION['user']->getId());

        $this->renderView(['contacts' => $contacts]);
    }
}