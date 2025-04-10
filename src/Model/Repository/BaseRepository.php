<?php

namespace App\Model\Repository;

use App\DI;
use App\Service\Connection;

abstract class BaseRepository {

    protected DI $di;
    protected Connection $connection;

    public function __construct(DI $di) {
        $this->di = $di;
        $this->connection = $this->di->getSingletonService('connection');
    }
}