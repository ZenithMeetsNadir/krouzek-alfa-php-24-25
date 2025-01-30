<?php

namespace App\Service;

use PDO;
use PDOStatement;

class Connection {
    protected PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=alfa24', 'root', '');
    }

    public function query(string $sql): array {
        $statement = $this->pdo->prepare($sql);

        if ($statement && $statement->execute())
            $rows = $statement->fetchAll();

        dd($rows);

        return $rows ?? [];
    }
}