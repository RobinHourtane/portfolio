<?php $footerGithubLink = getSetting('github_link') ?: 'https://github.com/'; ?>
<footer style="border-top: 1px solid var(--border); padding: 1rem; text-align: center; color: var(--text-secondary); font-size: 0.8rem; background: var(--bg-dark);">
        <div class="container">
            <p>Trouvez-moi sur : 
                <a href="<?= escape($footerGithubLink) ?>" target="_blank" style="color: var(--text-secondary); text-decoration: none;">
                    <i class="fab fa-github"></i> @robinhourtane
                </a>
            </p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
