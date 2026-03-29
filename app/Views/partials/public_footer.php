<?php $footerGithubLink = $footerGithubLink ?? 'https://github.com/'; ?>
<footer class="site-footer">
    <div class="container">
        <p>Trouvez-moi sur :
            <a href="<?= escape($footerGithubLink) ?>" target="_blank" class="site-footer-link">
                <i class="fab fa-github"></i> @robinhourtane
            </a>
        </p>
    </div>
</footer>
