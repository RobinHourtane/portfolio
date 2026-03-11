<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireLogin();

// Récupération des statistiques
$stats = [];
$stats['projects'] = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$stats['messages'] = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();

// Derniers messages
$latest_messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="admin-layout">
    <aside class="admin-sidebar">
        <div style="padding: 2rem; font-weight: bold; color: var(--text-main); border-bottom: 1px solid var(--border);">
            Admin Panel
        </div>
        <nav style="margin-top: 1rem;">
            <a href="index.php" class="admin-nav-item active"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="projects/list.php" class="admin-nav-item"><i class="fas fa-project-diagram"></i> Projets</a>
            <a href="messages.php" class="admin-nav-item"><i class="fas fa-envelope"></i> Messages</a>
            <a href="settings.php" class="admin-nav-item"><i class="fas fa-cog"></i> Paramètres</a>
            <a href="logout.php" class="admin-nav-item" style="color: var(--accent-rose); margin-top: 2rem;"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </aside>

    <main class="admin-content">
        <h1>Tableau de bord</h1>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem;">
            <div style="background: var(--bg-darker); padding: 1.5rem; border: 1px solid var(--border); border-radius: 8px;">
                <h3 style="color: var(--text-secondary);">Projets en ligne</h3>
                <p style="font-size: 2rem; color: var(--accent-turquoise);"><?= $stats['projects'] ?></p>
            </div>
            <div style="background: var(--bg-darker); padding: 1.5rem; border: 1px solid var(--border); border-radius: 8px;">
                <h3 style="color: var(--text-secondary);">Messages non lus</h3>
                <p style="font-size: 2rem; color: <?= $stats['messages'] > 0 ? 'var(--accent-rose)' : 'var(--text-main)' ?>;"><?= $stats['messages'] ?></p>
            </div>
        </div>

        <h2 style="margin-top: 3rem;">Derniers messages</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Sujet</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($latest_messages as $msg): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($msg['created_at'])) ?></td>
                    <td><?= escape($msg['name']) ?></td>
                    <td><?= escape($msg['subject']) ?></td>
                    <td>
                        <?php if($msg['is_read']): ?>
                            <span class="badge badge-success">Lu</span>
                        <?php else: ?>
                            <span class="badge badge-warning">Nouveau</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>