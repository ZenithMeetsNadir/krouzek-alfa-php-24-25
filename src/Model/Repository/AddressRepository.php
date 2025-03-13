<?php

namespace App\Model\Repository;

use App\Model\Repository\BaseRepository;

class AddressRepository extends BaseRepository {

    public function getById($id) {
        $queryResult = $this->connection->query("SELECT * FROM address WHERE id = ?", [$id]);

        dd($queryResult);
    }
}