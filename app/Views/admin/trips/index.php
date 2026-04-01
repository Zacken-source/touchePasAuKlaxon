<h1 class="h4 mb-3">Trajets</h1>
<div class="table-responsive">
<table class="table table-trips table-bordered">
    <thead>
        <tr>
            <th>Départ</th><th>Date</th><th>Heure</th>
            <th>Destination</th><th>Date</th><th>Heure</th>
            <th>Places</th><th>Auteur</th><th></th>
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
            <td><?= (int)$t['nb_places_dispo'] ?>/<?= (int)$t['nb_places_total'] ?></td>
            <td><?= htmlspecialchars($t['auteur_prenom'] . ' ' . $t['auteur_nom']) ?></td>
            <td>
                <form method="POST" action="/admin/trips/delete/<?= (int) $t['id'] ?>"
                      onsubmit="return confirm('Supprimer ce trajet ?')">
                    <button type="submit" class="btn-icon delete">&#128465;</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>