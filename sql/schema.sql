CREATE DATABASE IF NOT EXISTS klaxon
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE klaxon;

CREATE TABLE utilisateurs (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(100)  NOT NULL,
    prenom       VARCHAR(100)  NOT NULL,
    telephone    VARCHAR(20)   NOT NULL,
    email        VARCHAR(150)  NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255)  NOT NULL,
    role         ENUM('user', 'admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE agences (
    id  INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE trajets (
    id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    agence_depart_id  INT UNSIGNED NOT NULL,
    agence_arrivee_id INT UNSIGNED NOT NULL,
    gdh_depart        DATETIME NOT NULL,
    gdh_arrivee       DATETIME NOT NULL,
    nb_places_total   INT UNSIGNED NOT NULL,
    nb_places_dispo   INT UNSIGNED NOT NULL,
    utilisateur_id    INT UNSIGNED NOT NULL,
    FOREIGN KEY (agence_depart_id)  REFERENCES agences(id),
    FOREIGN KEY (agence_arrivee_id) REFERENCES agences(id),
    FOREIGN KEY (utilisateur_id)    REFERENCES utilisateurs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;