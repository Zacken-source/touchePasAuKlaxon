<?php

namespace App\Models;

use App\Core\Database;

class AgenceModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    public function findAll()
    {
        return $this->pdo->query('SELECT * FROM agences ORDER BY nom')->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create($nom)
    {
        $stmt = $this->pdo->prepare('INSERT INTO agences (nom) VALUES (?)');
        $stmt->execute([$nom]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update($id, $nom)
    {
        $stmt = $this->pdo->prepare('UPDATE agences SET nom = ? WHERE id = ?');
        $stmt->execute([$nom, $id]);
        return $stmt->rowCount() > 0;
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}