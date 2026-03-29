<?php
$adminSection = $adminSection ?? '';
$backUrl = $backUrl ?? null;
$backLabel = $backLabel ?? 'Retour';
?>
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        Admin Panel
    </div>

    <?php if (!empty($backUrl)): ?>
        <nav class="admin-sidebar-nav">
            <a href="<?= $backUrl ?>" class="admin-nav-item active"><?= escape($backLabel) ?></a>
        </nav>
    <?php endif; ?>

    <nav class="admin-sidebar-nav">
        <a href="<?= siteUrl('admin/index.php') ?>" class="admin-nav-item <?= $adminSection === 'dashboard' ? 'active' : '' ?>">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <a href="<?= siteUrl('admin/projects/list.php') ?>" class="admin-nav-item <?= $adminSection === 'projects' ? 'active' : '' ?>">
            <i class="fas fa-project-diagram"></i> Projets
        </a>
        <a href="<?= siteUrl('admin/messages.php') ?>" class="admin-nav-item <?= $adminSection === 'messages' ? 'active' : '' ?>">
            <i class="fas fa-envelope"></i> Messages
        </a>
        <a href="<?= siteUrl('admin/settings.php') ?>" class="admin-nav-item <?= $adminSection === 'settings' ? 'active' : '' ?>">
            <i class="fas fa-cog"></i> Paramètres
        </a>
        <a href="<?= siteUrl('admin/logout.php') ?>" class="admin-nav-item admin-nav-item--danger">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
    </nav>
</aside>
