<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Agences</h1>
    <a href="/admin/agencies/create" class="btn btn-primary btn-sm">+ Nouvelle agence</a>
</div>

<table class="table table-trips table-bordered">
    <thead><tr><th>#</th><th>Nom</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($agences as $ag): ?>
        <tr>
            <td><?= (int) $ag['id'] ?></td>
            <td><?= htmlspecialchars($ag['nom']) ?></td>
            <td>
                <a href="/admin/agencies/edit/<?= $ag['id'] ?>" class="btn-icon">&#9998;</a>
                <form method="POST" action="/admin/agencies/delete/<?= $ag['id'] ?>"
                      class="d-inline"
                      onsubmit="return confirm('Supprimer cette agence ?')">
                    <button type="submit" class="btn-icon delete">&#128465;</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>