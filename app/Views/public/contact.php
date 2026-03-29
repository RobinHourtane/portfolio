<div class="container flex-center contact-page">
    <div class="contact-container contact-page-card">
        <h1 class="contact-title">_contactez_moi</h1>

        <?php if ($messageSent): ?>
            <div class="alert alert-success contact-alert-success">
                <h3 class="contact-alert-success-title">Message envoyé ! 🚀</h3>
                <p>Merci <?= escape($_POST['name'] ?? '') ?>, je vous répondrai très vite.</p>
                <a href="<?= siteUrl('index.php') ?>" class="btn contact-home-link">Retour accueil</a>
            </div>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="alert alert-danger contact-alert-error"><?= escape($error) ?></div>
            <?php endif; ?>

            <form id="contact-form" method="POST" action="">
                <div class="form-group">
                    <label for="name" class="form-label">_nom</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">_email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">_sujet</label>
                    <input type="text" id="subject" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">_message</label>
                    <textarea id="message" name="message" class="form-control" rows="6" required></textarea>
                </div>

                <button type="submit" class="btn-primary">
                    envoyer-message()
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
