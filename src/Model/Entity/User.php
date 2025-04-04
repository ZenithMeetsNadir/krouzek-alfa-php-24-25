<?php

namespace App\Model\Entity;

use DateTime;

class User {

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
    protected ?int $addressId;

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): User
    {
        $this->addressId = $addressId;
        return $this;
    }

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

    public function setDateCreated(DateTime|string $dateCreated): User {
        if (is_string($dateCreated))
            $dateCreated = new DateTime($dateCreated);

        $this->dateCreated = $dateCreated;
        return $this;
    }

    public function getDateUpdated(): ?DateTime {
        return $this->dateUpdated;
    }

    public function setDateUpdated(DateTime|string|null $dateUpdated): User {
        if (is_string($dateUpdated))
            $dateUpdated = new DateTime($dateUpdated);

        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    public function getDateDeleted(): ?DateTime {
        return $this->dateDeleted;
    }

    public function setDateDeleted(DateTime|string|null $dateDeleted): User {
        if (is_string($dateDeleted))
            $dateDeleted = new DateTime($dateDeleted);

        $this->dateDeleted = $dateDeleted;
        return $this;
    }
}