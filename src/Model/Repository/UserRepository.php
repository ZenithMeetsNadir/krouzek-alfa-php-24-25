<?php

namespace App\Model\Repository;

use App\Exception\RecordNotfoundException;
use App\Model\Entity\User;

class UserRepository extends BaseRepository {

    public function constructUser(array $queryResult): User {
        $user = new User();
        $user
            ->setId($queryResult['id'])
            ->setFirstName($queryResult['first_name'])
            ->setLastName($queryResult['last_name'])
            ->setLogin($queryResult['login'])
            ->setEmail($queryResult['email'])
            ->setPassword($queryResult['password'])
            ->setPhone($queryResult['phone'])
            ->setDateCreated($queryResult['date_created'])
            ->setDateUpdated($queryResult['date_updated'])
            ->setDateDeleted($queryResult['date_deleted']);

        return $user;
    }

    /**
     * @throws RecordNotfoundException
     */
    public function findById(int $id): User {
        $queryResult = $this->connection->query("SELECT * FROM user WHERE id = ?", [$id]);

        if (isset($queryResult[0]))
            return $this->constructUser($queryResult[0]);

        throw new RecordNotFoundException("User not found");
    }
}