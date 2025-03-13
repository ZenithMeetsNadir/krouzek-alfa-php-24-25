<?php

namespace App\Model\Entity;

class Address {

    protected int $id;
    protected string $city;
    protected string $street;
    protected string $houseNumber;
    protected int $zipCode;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Address
    {
        $this->id = $id;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): Address
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): Address
    {
        $this->zipCode = $zipCode;
        return $this;
    }
}