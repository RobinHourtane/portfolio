<?php
namespace App\Models;

use PDO;

abstract class Model
{
    protected function db(): PDO
    {
        \requireDatabase();

        global $pdo;
        return $pdo;
    }

    protected function dbOrNull(): ?PDO
    {
        global $pdo;
        return $pdo instanceof PDO ? $pdo : null;
    }
}
