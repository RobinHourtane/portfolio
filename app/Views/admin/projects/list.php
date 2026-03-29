<div class="admin-list-header">
    <h1>Mes Projets</h1>
    <a href="<?= siteUrl('admin/projects/add.php') ?>" class="btn btn-primary btn-auto">+ Nouveau Projet</a>
</div>

<?php if ($success !== ''): ?>
    <div class="alert alert-success alert-spaced">Opération réussie !</div>
<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th class="column-image">Image</th>
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
                        <img src="<?= siteUrl('uploads/projects/' . $project['image_url']) ?>" class="project-thumb-admin">
                    <?php else: ?>
                        <span class="project-thumb-empty">Aucune</span>
                    <?php endif; ?>
                </td>
                <td><?= escape($project['title']) ?></td>
                <td><?= escape($project['category']) ?></td>
                <td><?= escape($project['type']) ?></td>
                <td><?= $project['is_published'] ? '<span class="badge badge-success">Publié</span>' : '<span class="badge badge-warning">Brouillon</span>' ?></td>
                <td>
                    <a href="<?= siteUrl('admin/projects/edit.php?id=' . $project['id']) ?>" class="btn btn-icon-compact"><i class="fas fa-edit"></i></a>
                    <a href="<?= siteUrl('admin/projects/delete.php?id=' . $project['id']) ?>" class="btn btn-icon-compact btn-delete" onclick="return confirm('Supprimer ce projet ?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
