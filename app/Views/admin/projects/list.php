<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Mes Projets</h1>
    <a href="<?= siteUrl('admin/projects/add.php') ?>" class="btn btn-primary" style="width: auto;">+ Nouveau Projet</a>
</div>

<?php if ($success !== ''): ?>
    <div class="alert alert-success" style="margin-top: 1rem;">Opération réussie !</div>
<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th width="80">Image</th>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Type</th>
            <th>État</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td>
                    <?php if ($project['image_url']): ?>
                        <img src="<?= siteUrl('uploads/projects/' . $project['image_url']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    <?php else: ?>
                        <span style="font-size: 0.8rem; color: gray;">Aucune</span>
                    <?php endif; ?>
                </td>
                <td><?= escape($project['title']) ?></td>
                <td><?= escape($project['category']) ?></td>
                <td><?= escape($project['type']) ?></td>
                <td><?= $project['is_published'] ? '<span class="badge badge-success">Publié</span>' : '<span class="badge badge-warning">Brouillon</span>' ?></td>
                <td>
                    <a href="<?= siteUrl('admin/projects/edit.php?id=' . $project['id']) ?>" class="btn" style="padding: 5px 10px;"><i class="fas fa-edit"></i></a>
                    <a href="<?= siteUrl('admin/projects/delete.php?id=' . $project['id']) ?>" class="btn" style="padding: 5px 10px; background: var(--accent-rose); color: #fff;" onclick="return confirm('Supprimer ce projet ?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
