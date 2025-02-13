<?php

namespace App\Model\Repository;

use App\DI;
use App\Service\Connection;

abstract class BaseRepository {

    protected Connection $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }
}