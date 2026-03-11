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
    <div class="nav-brand">Robin-Hourtané</div>
    
    <div class="mobile-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <div class="nav-menu">
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
</nav>