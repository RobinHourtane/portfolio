<?php $activePage = $activePage ?? ''; ?>
<nav class="navbar">
    <a href="<?= siteUrl('index.php') ?>" class="nav-brand">Robin-Hourtané</a>

    <button
        class="mobile-toggle"
        type="button"
        aria-label="Ouvrir le menu"
        aria-controls="site-menu"
        aria-expanded="false"
    >
        <i class="fas fa-bars" aria-hidden="true"></i>
    </button>

    <div class="nav-menu" id="site-menu" aria-hidden="false">
        <div class="nav-menu-panel">
            <div class="nav-menu-header">
                <a href="<?= siteUrl('index.php') ?>" class="nav-menu-brand">Robin-Hourtané</a>
                <button class="nav-close" type="button" aria-label="Fermer le menu">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <div class="nav-menu-links">
                <a href="<?= siteUrl('index.php') ?>" class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>">
                    _Bienvenue
                </a>
                <a href="<?= siteUrl('about.php') ?>" class="nav-link <?= $activePage === 'about' ? 'active' : '' ?>">
                    _À propos
                </a>
                <a href="<?= siteUrl('projects.php') ?>" class="nav-link <?= $activePage === 'projects' ? 'active' : '' ?>">
                    _projets
                </a>
                <a href="<?= siteUrl('contact.php') ?>" class="nav-link <?= $activePage === 'contact' ? 'active' : '' ?>">
                    contactez_moi
                </a>
            </div>
        </div>
    </div>
</nav>
