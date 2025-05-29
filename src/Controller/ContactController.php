<?php

namespace App\Controller;

use App\Attribute\RequireAuth;
use App\Controller\BaseController;
use App\Exception\RecordNotfoundException;
use App\Model\Entity\Contact;
use App\Model\Repository\ContactRepository;
use JetBrains\PhpStorm\NoReturn;

class ContactController extends BaseController {

    protected ContactRepository $contactRepo;

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

        $this->contactRepo->create($contact);

        $this->redirect->redirect('contact/list');
    }

    #[RequireAuth]
    public function updateFormAction() {
        if (isset($_SESSION['contactUpdateFormCache'])) {
            $contact = $_SESSION['contactUpdateFormCache'];
            unset($_SESSION['contactUpdateFormCache']);
        } else {
            try {
                $contact = $this->contactRepo->findById((int)$_GET['id']);
            } catch (RecordNotFoundException) {
                $this->redirect->redirect('error/e404');
            }
        }

        if ($contact->getUserId() != $_SESSION['user']->getId())
            $this->redirect->redirect('error/e403');

        $this->renderView(['contact' => $contact]);
    }

    public function updateAction() {
        $data = $_POST;

        $contact = $this->di->contactFactory();
        $contact
            ->setId($_POST['id'])
            ->setFirstName($_POST['firstName'])
            ->setLastName($_POST['lastName'])
            ->setEmail($_POST['email'])
            ->setPhone($_POST['phone'])
            ->setBirthdate($_POST['birthdate'])
            ->setNote($_POST['note']);

        if (empty($data['firstName'])) {
            $_SESSION['contactUpdateFormCache'] = $contact;
            $this->redirect->redirect('contact/updateForm');
        }

        try {
            $contactTemp = $this->contactRepo->findById($data['id']);
        } catch (RecordNotFoundException) {
            $this->redirect->redirect('error/e404');
        }

        if ($contactTemp->getUserId() != $_SESSION['user']->getId())
            $this->redirect->redirect('error/e403');

        $this->contactRepo->update($contact);

        $this->redirect->redirect('contact/list');
    }

    public function deleteAction() {
        try {
            $contact = $this->contactRepo->findById((int)$_GET['id']);
        } catch (RecordNotFoundException) {
            $this->redirect->redirect('error/e404');
        }

        if ($contact->getUserId() != $_SESSION['user']->getId())
            $this->redirect->redirect('error/e403');

        $this->contactRepo->delete($contact);

        $this->redirect->redirect('contact/list');
    }

    #[RequireAuth]
    public function listAction() {
        $contacts = $this->contactRepo->findByUserId($_SESSION['user']->getId());

        $this->renderView(['contacts' => $contacts]);
    }
}