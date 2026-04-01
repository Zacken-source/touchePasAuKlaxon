<?php $errors ??= []; $old ??= []; ?>

<div class="row">
<div class="col-md-6">
    <h1 class="h4 mb-4">Créer un trajet</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/trips/create">

        <div class="row g-2 mb-4 p-3 bg-white rounded border">
            <p class="mb-2 text-muted small">Vos informations (non modifiables)</p>
            <div class="col-6">
                <input type="text" class="form-control form-control-sm"
                       value="<?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>"
                       readonly>
            </div>
            <div class="col-6">
                <input type="text" class="form-control form-control-sm"
                       value="<?= htmlspecialchars($user['tel']) ?>" readonly>
            </div>
            <div class="col-12">
                <input type="email" class="form-control form-control-sm"
                       value="<?= htmlspecialchars($user['email']) ?>" readonly>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">Agence de départ</label>
                <select name="agence_depart_id" class="form-select" required>
                    <option value="">— Choisir —</option>
                    <?php foreach ($agences as $ag): ?>
                        <option value="<?= $ag['id'] ?>"
                            <?= ((int)($old['agence_depart_id'] ?? 0) == $ag['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ag['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Agence d'arrivée</label>
                <select name="agence_arrivee_id" class="form-select" required>
                    <option value="">— Choisir —</option>
                    <?php foreach ($agences as $ag): ?>
                        <option value="<?= $ag['id'] ?>"
                            <?= ((int)($old['agence_arrivee_id'] ?? 0) == $ag['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ag['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">Date et heure de départ</label>
                <input type="datetime-local" name="gdh_depart" class="form-control"
                       value="<?= htmlspecialchars($old['gdh_depart'] ?? '') ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label">Date et heure d'arrivée</label>
                <input type="datetime-local" name="gdh_arrivee" class="form-control"
                       value="<?= htmlspecialchars($old['gdh_arrivee'] ?? '') ?>" required>
            </div>
        </div>

        <div class="mb-4 col-4">
            <label class="form-label">Nombre de places</label>
            <input type="number" name="nb_places_total" class="form-control"
                   min="1" max="9"
                   value="<?= (int)($old['nb_places_total'] ?? 1) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer le trajet</button>
        <a href="/" class="btn btn-outline-secondary ms-2">Annuler</a>
    </form>
</div>
</div>