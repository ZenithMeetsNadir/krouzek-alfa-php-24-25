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
            ->setFirstName($record['first_name'])
            ->setLastName($record['last_name'])
            ->setEmail($record['email'])
            ->setPhone($record['phone'])
            ->setBirthdate($record['birthdate'])
            ->setUserId($record['user_id']);

        return $contact;
    }

    /**
     * @throws RecordNotfoundException
     */
    public function findById($id): Contact {
        $queryResult = $this->connection->query("SELECT * FROM contact WHERE id = ?", [$id]);

        if (isset($queryResult[0]))
            return $this->constructContact($queryResult[0]);

        throw new RecordNotfoundException("Address not found");
    }

    public function findByUserId(int $userId): array {
        $queryResult = $this->connection->query("SELECT * FROM contact WHERE user_id = ?", [$userId]);

        return array_map(fn($value): Contact => $this->constructContact($value), $queryResult);
    }

    public function save(Contact $contact) {
        $this->connection->query(
            "INSERT INTO contact (first_name, last_name, email, phone, birthdate, note , user_id) VALUES (?, ?, ?, ?, ?, ?, ?);",
            [$contact->getFirstName(), $contact->getLastName(), $contact->getEmail(), $contact->getPhone(), $contact->getBirthdate(), $contact->getNote(), $contact->getUserId()]
        );
    }
}