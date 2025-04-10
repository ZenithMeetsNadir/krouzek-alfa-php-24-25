<?php

namespace App\Model\Repository;

use App\Exception\RecordNotfoundException;
use App\Model\Entity\Contact;
use App\Service\Connection;

class ContactRepository extends BaseRepository {

    protected function constructContact(array $record): Contact {
        $contact = $this->di->contactFactory();
        $contact
            ->setId($record['id'])
            ->setFirstName($record['firstname'])
            ->setLastName($record['lastname'])
            ->setEmail($record['email'])
            ->setPhone($record['phone'])
            ->setBirthdate($record['birthdate'])
            ->setUserId($record['user_id']);

        return $contact;
    }

    /**
     * @throws RecordNotfoundException
     */
    public function getById($id): Address {
        $queryResult = $this->connection->query("SELECT * FROM address WHERE id = ?", [$id]);

        if (isset($queryResult[0]))
            return $this->constructContact($queryResult[0]);

        throw new RecordNotfoundException("Address not found");
    }
}