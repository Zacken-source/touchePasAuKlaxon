<?php

namespace App\Core;

use PDO;

/**
 * Connexion PDO en Singleton.
 */
class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/config.php';

        $dsn = 'mysql:host=' . $config['db']['host']
             . ';dbname=' . $config['db']['name']
             . ';charset=utf8mb4';

        $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}