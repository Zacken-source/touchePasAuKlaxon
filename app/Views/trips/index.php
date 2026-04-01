<?php
$user        = $user ?? null;
$isConnected = $user !== null;
$isAdmin     = $isConnected && $user['role'] === 'admin';
?>

<?php if (!$isConnected): ?>
    <p class="text-muted mb-3">
        Pour obtenir plus d'informations sur un trajet, veuillez vous connecter
    </p>
<?php endif; ?>

<h1 class="h4 mb-3">Trajets proposés</h1>

<?php if (empty($trips)): ?>
    <p class="text-muted">Aucun trajet disponible pour le moment.</p>
<?php else: ?>

<div class="table-responsive">
<table class="table table-trips table-bordered">
    <thead>
        <tr>
            <th>Départ</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Places</th>
            <?php if ($isConnected): ?><th></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($trips as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['agence_depart']) ?></td>
            <td><?= date('d/m/Y', strtotime($t['gdh_depart'])) ?></td>
            <td><?= date('H:i',   strtotime($t['gdh_depart'])) ?></td>
            <td><?= htmlspecialchars($t['agence_arrivee']) ?></td>
            <td><?= date('d/m/Y', strtotime($t['gdh_arrivee'])) ?></td>
            <td><?= date('H:i',   strtotime($t['gdh_arrivee'])) ?></td>
            <td><?= (int) $t['nb_places_dispo'] ?></td>

            <?php if ($isConnected): ?>
            <td class="text-nowrap">
                <button class="btn-icon"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-<?= (int) $t['id'] ?>"
                        title="Détails">&#128065;</button>

                <?php if ((int)$t['utilisateur_id'] === (int)$user['id'] || $isAdmin): ?>
                    <a href="/trips/edit/<?= (int) $t['id'] ?>"
                       class="btn-icon" title="Modifier">&#9998;</a>
                    <form method="POST" action="/trips/delete/<?= (int) $t['id'] ?>"
                          class="d-inline"
                          onsubmit="return confirm('Supprimer ce trajet ?')">
                        <button type="submit" class="btn-icon delete" title="Supprimer">&#128465;</button>
                    </form>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>

        <?php if ($isConnected): ?>
        <div class="modal fade" id="modal-<?= (int) $t['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <button type="button" class="btn-close float-end"
                                data-bs-dismiss="modal"></button>
                        <p>Auteur :
                            <strong>
                                <?= htmlspecialchars($t['auteur_prenom'] . ' ' . $t['auteur_nom']) ?>
                            </strong>
                        </p>
                        <p>Téléphone :
                            <strong><?= htmlspecialchars($t['auteur_tel']) ?></strong>
                        </p>
                        <p>Email :
                            <strong><?= htmlspecialchars($t['auteur_email']) ?></strong>
                        </p>
                        <p>Nombre total de places : <?= (int) $t['nb_places_total'] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php endif; ?>