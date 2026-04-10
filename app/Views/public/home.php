<main class="hero">
    <div class="hero-bg-blur blur-1"></div>
    <div class="hero-bg-blur blur-2"></div>

    <div class="container flex-center hero-stage">
        <div class="hero-grid">
            <div class="hero-content">
                <p class="hero-intro">Salut ! Je suis</p>
                <h1>Robin Hourtané</h1>
                <h2 class="hero-subtitle">> Full stack developer</h2>

                <div class="code-block hero-code-block">
                    <p class="comment hero-code-comment">// find my profile on Github:</p>
                    <p>
                        <span class="keyword">const</span>
                        <span class="hero-code-name">githubLink</span>
                        =
                        <span class="string">"<?= escape($githubLink) ?>"</span>;
                    </p>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-scratch-card">
                    <div class="hero-scratch-top" aria-hidden="true">
                        <div class="hero-scratch-dots">
                            <span class="hero-scratch-dot hero-scratch-dot-rose"></span>
                            <span class="hero-scratch-dot hero-scratch-dot-blue"></span>
                            <span class="hero-scratch-dot hero-scratch-dot-turquoise"></span>
                        </div>
                    </div>

                    <div class="hero-scratch-frame">
                        <iframe
                            class="hero-scratch-embed"
                            src="<?= assetUrl('grattage/index.php') ?>"
                            title="Portrait interactif à gratter de Robin Hourtané"
                        ></iframe>
                    </div>

                    <p class="hero-scratch-note">Gratte la silhouette pour révéler ma photo.</p>
                </div>
            </div>
        </div>
    </div>
</main>
