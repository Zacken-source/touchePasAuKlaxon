<?php $errors ??= []; ?>

<div class="row">
<div class="col-md-6">
    <h1 class="h4 mb-4">Modifier le trajet</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/trips/edit/<?= (int) $trip['id'] ?>">
        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">Agence de départ</label>
                <select name="agence_depart_id" class="form-select" required>
                    <?php foreach ($agences as $ag): ?>
                        <option value="<?= $ag['id'] ?>"
                            <?= ((int)$trip['agence_depart_id'] == $ag['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ag['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Agence d'arrivée</label>
                <select name="agence_arrivee_id" class="form-select" required>
                    <?php foreach ($agences as $ag): ?>
                        <option value="<?= $ag['id'] ?>"
                            <?= ((int)$trip['agence_arrivee_id'] == $ag['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ag['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">Date et heure de départ</label>
                <?php $depVal = date('Y-m-d\TH:i', strtotime($trip['gdh_depart'])); ?>
                <input type="datetime-local" name="gdh_depart" class="form-control"
                       value="<?= htmlspecialchars($depVal) ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label">Date et heure d'arrivée</label>
                <?php $arrVal = date('Y-m-d\TH:i', strtotime($trip['gdh_arrivee'])); ?>
                <input type="datetime-local" name="gdh_arrivee" class="form-control"
                       value="<?= htmlspecialchars($arrVal) ?>" required>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-4">
                <label class="form-label">Places totales</label>
                <input type="number" name="nb_places_total" class="form-control"
                       min="1" max="9" value="<?= (int)$trip['nb_places_total'] ?>" required>
            </div>
            <div class="col-4">
                <label class="form-label">Places disponibles</label>
                <input type="number" name="nb_places_dispo" class="form-control"
                       min="0" value="<?= (int)$trip['nb_places_dispo'] ?>" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/" class="btn btn-outline-secondary ms-2">Annuler</a>
    </form>
</div>
</div>