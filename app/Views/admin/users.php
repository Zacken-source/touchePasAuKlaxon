<h1 class="h4 mb-3">Utilisateurs</h1>
<table class="table table-trips table-bordered">
    <thead>
        <tr>
            <th>#</th><th>Nom</th><th>Prénom</th>
            <th>Email</th><th>Téléphone</th><th>Rôle</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= (int) $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nom']) ?></td>
            <td><?= htmlspecialchars($u['prenom']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['telephone']) ?></td>
            <td>
                <span class="badge <?= $u['role'] === 'admin' ? 'bg-danger' : 'bg-secondary' ?>">
                    <?= $u['role'] ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>