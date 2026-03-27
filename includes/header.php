<?php
// Détermine la page active pour la classe CSS
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? escape($pageTitle) . ' - ' : '' ?>Robin Hourtané</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-brand">Robin-Hourtané</a>
    
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
                <a href="index.php" class="nav-menu-brand">Robin-Hourtané</a>
                <button class="nav-close" type="button" aria-label="Fermer le menu">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <div class="nav-menu-links">
                <a href="index.php" class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>">
                    _Bienvenue
                </a>
                <a href="about.php" class="nav-link <?= $current_page == 'about.php' ? 'active' : '' ?>">
                    _À propos
                </a>
                <a href="projects.php" class="nav-link <?= $current_page == 'projects.php' ? 'active' : '' ?>">
                    _projets
                </a>
                <a href="contact.php" class="nav-link <?= $current_page == 'contact.php' ? 'active' : '' ?>">
                    contactez_moi
                </a>
            </div>
        </div>
    </div>
</nav>
