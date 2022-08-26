<?php

namespace Thiago\Crud\Infrastructure\Persistence;

use PDO;

class ConnectionFactory
{
    public static function CreateConnection(): PDO{
        $dns = 'mysql:host=localhost;dbname=crud_produtos';
        $user = 'root';
        $password = '';

        $pdo = new PDO($dns, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}