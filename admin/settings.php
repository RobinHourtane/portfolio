<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'])) die('Erreur CSRF');

    // Mise à jour des settings
    $settingsToUpdate = ['github_link', 'email', 'phone', 'bio'];
    
    $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    
    foreach ($settingsToUpdate as $key) {
        if (isset($_POST[$key])) {
            $val = trim($_POST[$key]);
            $stmt->execute([$key, $val, $val]);
        }
    }
    
    // Changement mot de passe
    if (!empty($_POST['new_password'])) {
        $newPass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $updPass = $pdo->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $updPass->execute([$newPass, $_SESSION['admin_id']]);
    }
    
    redirect('settings.php?success=1');
}

// Récupérer valeurs actuelles
$currentSettings = [];
$s = $pdo->query("SELECT * FROM settings")->fetchAll();
foreach($s as $row) {
    $currentSettings[$row['setting_key']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paramètres</title>
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
                <a href="messages.php" class="admin-nav-item"><i class="fas fa-envelope"></i> Messages</a>
                <a href="settings.php" class="admin-nav-item active"><i class="fas fa-cog"></i> Paramètres</a>
            </nav>
        </aside>
        
        <main class="admin-content">
            <h1>Paramètres du site</h1>
            
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success">Paramètres sauvegardés.</div>
            <?php endif; ?>

            <form method="POST" style="max-width: 600px;">
                <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                
                <h3 style="margin-top: 2rem; color: var(--text-main);">Infos Générales</h3>
                
                <div class="form-group">
                    <label class="form-label">Lien GitHub</label>
                    <input type="url" name="github_link" class="form-control" value="<?= escape($currentSettings['github_link'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Email Contact</label>
                    <input type="email" name="email" class="form-control" value="<?= escape($currentSettings['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="<?= escape($currentSettings['phone'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Texte "Bio" (Page À propos)</label>
                    <textarea name="bio" class="form-control" rows="8" style="font-family: monospace;"><?= escape($currentSettings['bio'] ?? '') ?></textarea>
                </div>

                <h3 style="margin-top: 2rem; color: var(--text-main);">Sécurité</h3>
                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe admin (laisser vide pour ne pas changer)</label>
                    <input type="password" name="new_password" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
            </form>
        </main>
    </div>
</body>
</html>