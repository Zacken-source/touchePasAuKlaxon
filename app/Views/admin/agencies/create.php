<?php $errors ??= []; ?>
<div class="col-md-4">
    <h1 class="h4 mb-3">Nouvelle agence</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e): ?>
                <p class="mb-0"><?= htmlspecialchars($e) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/admin/agencies/create">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la ville</label>
            <input type="text" id="nom" name="nom" class="form-control" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="/admin/agencies" class="btn btn-outline-secondary ms-2">Annuler</a>
    </form>
</div>