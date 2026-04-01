<?php

namespace App\Models;

use App\Core\Database;

class UserModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function findAll()
    {
        return $this->pdo->query('SELECT * FROM utilisateurs ORDER BY nom, prenom')->fetchAll();
    }

    public function authenticate($email, $password)
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user['mot_de_passe'])) {
            return null;
        }

        return $user;
    }
}