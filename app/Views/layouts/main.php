<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Touche Pas Au Klaxon') ?></title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>

<?php require __DIR__ . '/../partials/header.php'; ?>

<main class="container py-4">
    <?php require __DIR__ . '/../partials/flash.php'; ?>
    <?= $content ?>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>