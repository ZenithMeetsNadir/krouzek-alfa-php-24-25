<?php

namespace App\Model;

use DateTime;

class User implements IFetchConstructible {

    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $login;
    protected string $email;
    protected string $password;
    protected ?string $phone;
    protected DateTime $dateCreated;
    protected ?DateTime $dateUpdated;
    protected ?Datetime $dateDeleted;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): User {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): User {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): User {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function setLogin(string $login): User {
        $this->login = $login;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): User {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): User {
        $this->password = $password;
        return $this;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function setPhone(?string $phone): User {
        $this->phone = $phone;
        return $this;
    }

    public function getDateCreated(): DateTime {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $dateCreated): User {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    public function getDateUpdated(): ?DateTime {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?DateTime $dateUpdated): User {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    public function getDateDeleted(): ?DateTime {
        return $this->dateDeleted;
    }

    public function setDateDeleted(?DateTime $dateDeleted): User {
        $this->dateDeleted = $dateDeleted;
        return $this;
    }

    public function constructFrom(array $fetchData): mixed
    {
        $user = new User();
        $user
            ->setId($fetchData['id']);

        return $user;
    }
}