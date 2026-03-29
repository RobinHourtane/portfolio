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
        <span class="mobile-toggle-dot" aria-hidden="true"></span>
        <span class="mobile-toggle-bars" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </button>

    <div class="nav-menu" id="site-menu" aria-hidden="false">
        <div class="nav-menu-panel">
            <div class="nav-menu-header">
                <div class="nav-menu-heading">
                    <span class="nav-menu-kicker">// navigation</span>
                    <a href="<?= siteUrl('index.php') ?>" class="nav-menu-brand">Robin-Hourtané</a>
                </div>
                <button class="nav-close" type="button" aria-label="Fermer le menu">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <div class="nav-menu-intro">
                <span class="nav-menu-chip">portfolio.map</span>
                <p class="nav-menu-copy">
                    Navigue dans les pages principales du portfolio comme dans un fichier ouvert.
                </p>
            </div>

            <div class="nav-menu-links">
                <a href="<?= siteUrl('index.php') ?>" class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>">
                    <span class="nav-link-index">01.</span>
                    <span class="nav-link-copy">
                        <span class="nav-link-title">_Bienvenue</span>
                        <span class="nav-link-route">index.php</span>
                    </span>
                    <span class="nav-link-arrow" aria-hidden="true">-&gt;</span>
                </a>
                <a href="<?= siteUrl('about.php') ?>" class="nav-link <?= $activePage === 'about' ? 'active' : '' ?>">
                    <span class="nav-link-index">02.</span>
                    <span class="nav-link-copy">
                        <span class="nav-link-title">_À propos</span>
                        <span class="nav-link-route">about.php</span>
                    </span>
                    <span class="nav-link-arrow" aria-hidden="true">-&gt;</span>
                </a>
                <a href="<?= siteUrl('projects.php') ?>" class="nav-link <?= $activePage === 'projects' ? 'active' : '' ?>">
                    <span class="nav-link-index">03.</span>
                    <span class="nav-link-copy">
                        <span class="nav-link-title">_projets</span>
                        <span class="nav-link-route">projects.php</span>
                    </span>
                    <span class="nav-link-arrow" aria-hidden="true">-&gt;</span>
                </a>
                <a href="<?= siteUrl('contact.php') ?>" class="nav-link <?= $activePage === 'contact' ? 'active' : '' ?>">
                    <span class="nav-link-index">04.</span>
                    <span class="nav-link-copy">
                        <span class="nav-link-title">contactez_moi</span>
                        <span class="nav-link-route">contact.php</span>
                    </span>
                    <span class="nav-link-arrow" aria-hidden="true">-&gt;</span>
                </a>
            </div>
        </div>
    </div>
</nav>
