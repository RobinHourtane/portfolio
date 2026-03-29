<h1>Paramètres du site</h1>

<?php if ($success): ?>
    <div class="alert alert-success">Paramètres sauvegardés.</div>
<?php endif; ?>

<form method="POST" class="settings-form">
    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

    <h3 class="settings-section-title">Infos Générales</h3>

    <div class="form-group">
        <label class="form-label">Lien GitHub</label>
        <input type="url" name="github_link" class="form-control" value="<?= escape($currentSettings['github_link'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Email Contact</label>
        <input type="email" name="email" class="form-control" value="<?= escape($currentSettings['email'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Téléphone</label>
        <input type="text" name="phone" class="form-control" value="<?= escape($currentSettings['phone'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Texte "Bio" (Page À propos)</label>
        <textarea name="bio" class="form-control settings-textarea-code" rows="8"><?= escape($currentSettings['bio'] ?? '') ?></textarea>
    </div>

    <h3 class="settings-section-title">Sécurité</h3>
    <div class="form-group">
        <label class="form-label">Nouveau mot de passe admin (laisser vide pour ne pas changer)</label>
        <input type="password" name="new_password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
</form>
