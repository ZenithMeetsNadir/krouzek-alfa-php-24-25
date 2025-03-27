<?php

namespace App\Model\Repository;

use App\Exception\RecordNotfoundException;
use App\Model\Entity\Address;
use App\Model\Repository\BaseRepository;

class AddressRepository extends BaseRepository {

    protected function constructAddress(array $record): Address {
        $address = new Address();
        $address
            ->setId($record['id'])
            ->setCity($record['city'])
            ->setStreet($record['street'])
            ->setHouseNumber($record['house_number'])
            ->setZipCode($record['zip_code']);

        return $address;
    }

    /**
     * @throws RecordNotfoundException
     */
    public function getById($id): Address {
        $queryResult = $this->connection->query("SELECT * FROM address WHERE id = ?", [$id]);

        if (isset($queryResult[0]))
            return $this->constructAddress($queryResult[0]);

        throw new RecordNotfoundException("Address not found");
    }
}