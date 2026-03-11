<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "_Bienvenue";
$githubLink = getSetting('github_link') ?? 'https://github.com/';

require_once 'includes/header.php';
?>

<main class="hero">
    <div class="hero-bg-blur blur-1"></div>
    <div class="hero-bg-blur blur-2"></div>

    <div class="container flex-center" style="height: 100%;">
        <div class="hero-grid">
            
            <div class="hero-content">
                <p style="color: var(--text-secondary); font-size: 1.1rem;">Salut ! Je suis</p>
                <h1>Robin Hourtané</h1>
                <h2 class="hero-subtitle">> Full stack developer</h2>
                
                <div class="code-block" style="margin-top: 3rem;">
                    <p class="comment" style="color: var(--text-secondary);">// find my profile on Github:</p>
                    <p>
                        <span style="color: var(--accent-purple);">const</span> 
                        <span style="color: var(--accent-turquoise);">githubLink</span> 
                        = 
                        <span style="color: var(--accent-rose);">"<?= escape($githubLink) ?>"</span>;
                    </p>
                </div>
            </div>

            <div class="hero-visual">
                </div>
            
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>