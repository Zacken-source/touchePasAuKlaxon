<?php

namespace App\Models;

use App\Core\Database;

class TripModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    public function findAvailable()
    {
        $sql = "
            SELECT t.*,
                   ad.nom      AS agence_depart,
                   aa.nom      AS agence_arrivee,
                   u.nom       AS auteur_nom,
                   u.prenom    AS auteur_prenom,
                   u.telephone AS auteur_tel,
                   u.email     AS auteur_email
            FROM trajets t
            JOIN agences ad ON ad.id = t.agence_depart_id
            JOIN agences aa ON aa.id = t.agence_arrivee_id
            JOIN utilisateurs u ON u.id = t.utilisateur_id
            WHERE t.nb_places_dispo > 0
              AND t.gdh_depart > NOW()
            ORDER BY t.gdh_depart ASC
        ";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM trajets WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO trajets
                (agence_depart_id, agence_arrivee_id, gdh_depart, gdh_arrivee,
                 nb_places_total, nb_places_dispo, utilisateur_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['agence_depart_id'],
            $data['agence_arrivee_id'],
            $data['gdh_depart'],
            $data['gdh_arrivee'],
            $data['nb_places_total'],
            $data['nb_places_total'],
            $data['utilisateur_id'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("
            UPDATE trajets SET
                agence_depart_id  = ?,
                agence_arrivee_id = ?,
                gdh_depart        = ?,
                gdh_arrivee       = ?,
                nb_places_total   = ?,
                nb_places_dispo   = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $data['agence_depart_id'],
            $data['agence_arrivee_id'],
            $data['gdh_depart'],
            $data['gdh_arrivee'],
            $data['nb_places_total'],
            $data['nb_places_dispo'],
            $id,
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM trajets WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}