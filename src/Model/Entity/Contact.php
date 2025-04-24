<?php

namespace App\Model\Entity;

use App\Exception\RecordNotfoundException;
use App\Model\Repository\UserRepository;
use DateTime;

class Contact {

    protected int $id;
    protected string $firstName;
    protected ?string $lastName;
    protected ?string $email;
    protected ?string $phone;
    protected ?string $birthdate;
    protected ?string $note;
    protected int $userId;
    protected ?User $user;

    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): Contact {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): Contact {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): Contact {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): Contact {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function setPhone(?string $phone): Contact {
        $this->phone = $phone;
        return $this;
    }

    public function getBirthdate(): ?string {
        return $this->birthdate;
    }

    public function setBirthdate(?string $birthdate): Contact {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getNote(): ?string {
        return $this->note;
    }

    public function setNote(?string $note): Contact {
        $this->note = $note;
        return $this;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): Contact {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @throws RecordNotfoundException
     */
    public function getUser(): User {
        if ($this->user == null)
            $this->user = $this->userRepo->findById($this->userId);

        return $this->user;
    }

    public function __toString(): string {
        return $this->firstName . ' ' . $this->lastName;
    }
}