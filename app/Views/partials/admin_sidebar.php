<?php
$adminSection = $adminSection ?? '';
$backUrl = $backUrl ?? null;
$backLabel = $backLabel ?? 'Retour';
?>
<aside class="admin-sidebar">
    <div style="padding: 2rem; font-weight: bold; color: var(--text-main); border-bottom: 1px solid var(--border);">
        Admin Panel
    </div>

    <?php if (!empty($backUrl)): ?>
        <nav style="margin-top: 1rem;">
            <a href="<?= $backUrl ?>" class="admin-nav-item active"><?= escape($backLabel) ?></a>
        </nav>
    <?php endif; ?>

    <nav style="margin-top: 1rem;">
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
        <a href="<?= siteUrl('admin/logout.php') ?>" class="admin-nav-item" style="color: var(--accent-rose); margin-top: 2rem;">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
    </nav>
</aside>
