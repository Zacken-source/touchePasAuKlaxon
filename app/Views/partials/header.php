<?php
use App\Core\Session;

$user    = Session::get('user');
$isAdmin = $user && $user['role'] === 'admin';
$isUser  = $user && $user['role'] === 'user';
?>
<nav class="navbar navbar-expand px-3">
    <div class="container-fluid">

        <?php if ($isAdmin): ?>
            <a class="navbar-brand" href="/admin">Touche pas au klaxon</a>
        <?php else: ?>
            <span class="navbar-brand">Touche pas au klaxon</span>
        <?php endif; ?>

        <div class="ms-auto d-flex align-items-center gap-2">

            <?php if ($isAdmin): ?>
                <a href="/admin/users"    class="btn btn-secondary btn-sm">Utilisateurs</a>
                <a href="/admin/agencies" class="btn btn-secondary btn-sm">Agences</a>
                <a href="/admin/trips"    class="btn btn-secondary btn-sm">Trajets</a>
                <span class="text-muted small">
                    Bonjour <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                </span>
                <a href="/logout" class="btn btn-dark btn-sm">Déconnexion</a>

            <?php elseif ($isUser): ?>
                <a href="/trips/create" class="btn btn-dark btn-sm">Créer un trajet</a>
                <span class="text-muted small">
                    Bonjour <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                </span>
                <a href="/logout" class="btn btn-dark btn-sm">Déconnexion</a>

            <?php else: ?>
                <a href="/login" class="btn btn-dark btn-sm">Connexion</a>
            <?php endif; ?>

        </div>
    </div>
</nav>