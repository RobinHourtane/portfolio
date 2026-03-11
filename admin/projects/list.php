<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';
requireLogin();

// Suppression via paramètre GET (sécurisé via token CSRF idéalement, ici simple pour l'exemple)
// Voir fichier delete.php pour la logique complète

$projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les projets</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="admin-layout">
    <aside class="admin-sidebar">
        <div style="padding: 2rem; font-weight: bold; color: var(--text-main); border-bottom: 1px solid var(--border);">Admin Panel</div>
        <nav style="margin-top: 1rem;">
            <a href="../index.php" class="admin-nav-item"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="list.php" class="admin-nav-item active"><i class="fas fa-project-diagram"></i> Projets</a>
            <a href="../messages.php" class="admin-nav-item"><i class="fas fa-envelope"></i> Messages</a>
            <a href="../settings.php" class="admin-nav-item"><i class="fas fa-cog"></i> Paramètres</a>
            <a href="../logout.php" class="admin-nav-item" style="color: var(--accent-rose); margin-top: 2rem;"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </aside>

    <main class="admin-content">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Mes Projets</h1>
            <a href="add.php" class="btn btn-primary" style="width: auto;">+ Nouveau Projet</a>
        </div>

        <?php if(isset($_GET['success'])): ?>
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
                <?php foreach($projects as $p): ?>
                <tr>
                    <td>
                        <?php if($p['image_url']): ?>
                            <img src="../../uploads/projects/<?= escape($p['image_url']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <span style="font-size: 0.8rem; color: gray;">Aucune</span>
                        <?php endif; ?>
                    </td>
                    <td><?= escape($p['title']) ?></td>
                    <td><?= escape($p['category']) ?></td>
                    <td><?= escape($p['type']) ?></td>
                    <td>
                        <?= $p['is_published'] ? '<span class="badge badge-success">Publié</span>' : '<span class="badge badge-warning">Brouillon</span>' ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $p['id'] ?>" class="btn" style="padding: 5px 10px;"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id=<?= $p['id'] ?>" class="btn" style="padding: 5px 10px; background: var(--accent-rose); color: #fff;" onclick="return confirm('Supprimer ce projet ?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>