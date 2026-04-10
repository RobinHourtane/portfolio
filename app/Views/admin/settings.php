<h1>Paramètres du site</h1>

<?php if ($success): ?>
    <div class="alert alert-success">Paramètres sauvegardés.</div>
<?php endif; ?>

<?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger"><?= escape($errorMessage) ?></div>
<?php endif; ?>

<?php $hasCustomAboutImage = !empty($currentSettings['about_image']); ?>
<?php $hasCustomScratchImage = !empty($currentSettings['scratch_image']); ?>

<form method="POST" enctype="multipart/form-data" class="settings-form">
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

    <div class="form-group">
        <label class="form-label">Image de biographie</label>

        <div class="settings-image-preview">
            <img src="<?= escape($currentAboutImageUrl) ?>" alt="Image de biographie actuelle" class="settings-image-preview-image">
        </div>

        <?php if ($hasCustomAboutImage): ?>
            <p class="settings-current-file">Fichier actuel : <?= escape($currentSettings['about_image']) ?></p>
        <?php endif; ?>

        <input type="file" name="about_image" class="form-control" accept="image/*">
        <p class="settings-help">Formats acceptes : JPG, PNG, WEBP, GIF. Taille max : 5 Mo.</p>

        <?php if ($hasCustomAboutImage): ?>
            <label class="settings-inline-option">
                <input type="checkbox" name="remove_about_image" value="1">
                Revenir a l'image par defaut
            </label>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label class="form-label">Image a gratter</label>

        <div class="settings-image-preview settings-image-preview-scratch">
            <img src="<?= escape($currentScratchImageUrl) ?>" alt="Image a gratter actuelle" class="settings-image-preview-image">
        </div>

        <?php if ($hasCustomScratchImage): ?>
            <p class="settings-current-file">Fichier actuel : <?= escape($currentSettings['scratch_image']) ?></p>
        <?php endif; ?>

        <input type="file" name="scratch_image" class="form-control" accept="image/*">
        <p class="settings-help">Cette image est utilisee dans la scratch-card de la page d'accueil. Formats acceptes : JPG, PNG, WEBP, GIF. Taille max : 5 Mo.</p>

        <?php if ($hasCustomScratchImage): ?>
            <label class="settings-inline-option">
                <input type="checkbox" name="remove_scratch_image" value="1">
                Revenir a l'image par defaut du module
            </label>
        <?php endif; ?>
    </div>

    <h3 class="settings-section-title">Sécurité</h3>
    <div class="form-group">
        <label class="form-label">Nouveau mot de passe admin (laisser vide pour ne pas changer)</label>
        <input type="password" name="new_password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
</form>
