<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireLogin();

// Marquer comme lu
if (isset($_GET['read'])) {
    $stmt = $pdo->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
    $stmt->execute([$_GET['read']]);
    redirect('messages.php');
}

// Supprimer
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    redirect('messages.php');
}

$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
             <div style="padding: 2rem; font-weight: bold; color: var(--text-main);">Admin Panel</div>
             <nav style="margin-top: 1rem;">
                <a href="index.php" class="admin-nav-item"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="projects/list.php" class="admin-nav-item"><i class="fas fa-project-diagram"></i> Projets</a>
                <a href="messages.php" class="admin-nav-item active"><i class="fas fa-envelope"></i> Messages</a>
                <a href="settings.php" class="admin-nav-item"><i class="fas fa-cog"></i> Paramètres</a>
            </nav>
        </aside>
        
        <main class="admin-content">
            <h1>Messagerie</h1>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>De</th>
                        <th>Sujet</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($messages as $msg): ?>
                    <tr style="<?= !$msg['is_read'] ? 'background: rgba(255,255,255,0.05);' : '' ?>">
                        <td>
                            <div><?= escape($msg['name']) ?></div>
                            <small style="color: var(--text-secondary);"><?= escape($msg['email']) ?></small>
                            <div style="font-size: 0.7rem; color: gray;"><?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?></div>
                        </td>
                        <td><?= escape($msg['subject']) ?></td>
                        <td>
                            <div style="max-width: 400px; max-height: 100px; overflow-y: auto; white-space: pre-wrap; font-size: 0.9rem; color: var(--text-secondary);">
                                <?= escape($msg['message']) ?>
                            </div>
                        </td>
                        <td>
                            <?php if(!$msg['is_read']): ?>
                                <a href="?read=<?= $msg['id'] ?>" class="btn" title="Marquer lu"><i class="fas fa-check"></i></a>
                            <?php endif; ?>
                            <a href="mailto:<?= escape($msg['email']) ?>" class="btn"><i class="fas fa-reply"></i></a>
                            <a href="?delete=<?= $msg['id'] ?>" class="btn" style="color: var(--accent-rose);" onclick="return confirm('Supprimer ?');"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>