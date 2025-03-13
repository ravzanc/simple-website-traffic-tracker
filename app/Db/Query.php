<?php

declare(strict_types=1);

namespace App\Db;

class Query
{
    public static function insert(string $query, string $types, ...$values): bool
    {
        $pdo = Connection::getInstance()->connect();

        $statement = $pdo->prepare($query);
        $statement->bind_param($types, ...$values);

        $insert = $statement->execute();

        $statement->close();
        $pdo->close();

        return $insert;
    }

    public static function select(string $query, ?array $bindValues = null): array
    {
        $pdo = Connection::getInstance()->connect();

        $statement = $pdo->prepare($query);
        $statement->execute($bindValues);

        $data = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

        $statement->close();
        $pdo->close();

        return $data;
    }
}
