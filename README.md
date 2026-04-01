# touchePasAuKlaxon# Touche Pas Au Klaxon

Application de covoiturage intranet développée en PHP avec une architecture MVC.

## Technologies

- PHP 8.0+
- MySQL / MariaDB
- Bootstrap 5 + Sass
- izniburak/router
- PHPUnit
- PHPStan

## Installation

### Prérequis

- PHP >= 8.0 avec PDO et pdo_mysql
- Composer
- Node.js + npm
- MySQL ou MariaDB

### Étapes
```bash
# 1. Cloner le projet
git clone https://github.com/votre-compte/touche-pas-au-klaxon.git
cd touche-pas-au-klaxon

# 2. Installer les dépendances PHP
composer install

# 3. Créer la base de données
mysql -u root -p < sql/schema.sql

# 4. Générer le hash du mot de passe
php gen_hash.php
# Copier la valeur et remplacer LE_HASH dans sql/seed.sql

# 5. Insérer les données de test
mysql -u root -p klaxon < sql/seed.sql

# 6. Modifier config/config.php avec vos identifiants BDD

# 7. Compiler le CSS
npm install
npm run sass

# 8. Lancer le serveur
php -S localhost:4000 -t public
```

## Comptes de test

| Rôle           | Email                      | Mot de passe |
|----------------|----------------------------|--------------|
| Administrateur | admin@klaxon.fr            | Password1!   |
| Utilisateur    | alexandre.martin@email.fr  | Password1!   |

## Tests
```bash
./vendor/bin/phpunit
```

## Analyse statique
```bash
./vendor/bin/phpstan analyse
```