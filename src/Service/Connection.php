<?php

namespace App\Service;

use PDO;
use PDOStatement;

final class Connection {
    protected PDO $pdo;

    public function __construct(string $host, string $database, string $user, string $password) {
        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $password);
    }

    public function query(string $sql): array {
        $statement = $this->pdo->prepare($sql);

        if ($statement && $statement->execute())
            $rows = $statement->fetchAll();

        return $rows ?? [];
    }
}