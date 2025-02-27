<?php

namespace App\Service;

use App\Exception\QueryException;
use PDO;
use PDOStatement;

final class Connection {
    protected PDO $pdo;

    public function __construct(string $host, string $database, string $user, string $password) {
        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $password);
    }

    public function query(string $sql, array $params = []): array {
        $statement = $this->pdo->prepare($sql);

        if ($statement && $statement->execute($params))
            $rows = $statement->fetchAll();
        else
            throw new PDOException("Query $sql failed.");

        return $rows;
    }
}