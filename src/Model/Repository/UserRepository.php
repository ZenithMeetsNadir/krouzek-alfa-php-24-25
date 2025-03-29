<?php

namespace App\Model\Repository;

use App\Exception\RecordNotfoundException;
use App\Model\Entity\User;

class UserRepository extends BaseRepository {

    protected function constructUser(array $record): User {
        $user = new User();
        $user
            ->setId($record['id'])
            ->setFirstName($record['first_name'])
            ->setLastName($record['last_name'])
            ->setLogin($record['login'])
            ->setEmail($record['email'])
            ->setPassword($record['password'])
            ->setPhone($record['phone'])
            ->setDateCreated($record['date_created'])
            ->setDateUpdated($record['date_updated'])
            ->setDateDeleted($record['date_deleted']);

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

    /**
     * @throws RecordNotfoundException
     */
    public function findByLogin(string $login): User {
        $queryResult = $this->connection->query("SELECT * FROM user WHERE login = ?", [$login]);

        if (isset($queryResult[0]))
            return $this->constructUser($queryResult[0]);

        throw new RecordNotFoundException("User not found");
    }

    /**
     * @throws RecordNotfoundException
     */
    public function findByEmail(string $email): User {
        $queryResult = $this->connection->query("SELECT * FROM user WHERE email = ?", [$email]);

        if (isset($queryResult[0]))
            return $this->constructUser($queryResult[0]);

        throw new RecordNotFoundException("User not found");
    }

    /**
     * @throws RecordNotfoundException
     */
    public function findByAnyLogin(string $login): User {
        $queryResult = $this->connection->query("SELECT * FROM user WHERE login = ? OR email = ?", [$login, $login]);

        if (isset($queryResult[0]))
            return $this->constructUser($queryResult[0]);

        throw new RecordNotFoundException("User not found");
    }

    public function changePassword(int $id, string $password): void {
        $this->connection->query("UPDATE user SET password = ? WHERE id = ?", [$password, $id]);
    }
}