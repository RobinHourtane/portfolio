<h1><?= escape($heading) ?></h1>

<?php if ($success): ?>
    <div class="alert alert-success alert-spaced">Projet mis à jour.</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" action="<?= $formAction ?>" class="project-form">
    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

    <div class="form-group">
        <label class="form-label">Titre *</label>
        <input type="text" name="title" class="form-control" value="<?= escape($project['title'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Sous-titre</label>
        <input type="text" name="subtitle" class="form-control" value="<?= escape($project['subtitle'] ?? '') ?>">
    </div>

    <div class="form-grid-two">
        <div class="form-group">
            <label class="form-label">Catégorie</label>
            <select name="category" class="form-control">
                <?php foreach ($categoryOptions as $value => $label): ?>
                    <option value="<?= escape($value) ?>" <?= ($project['category'] ?? '') === $value ? 'selected' : '' ?>><?= escape($label) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Type</label>
            <select name="type" class="form-control">
                <?php foreach ($typeOptions as $value => $label): ?>
                    <option value="<?= escape($value) ?>" <?= ($project['type'] ?? '') === $value ? 'selected' : '' ?>><?= escape($label) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Logiciels utilisés<?= empty($project['id']) ? ' (séparés par des virgules)' : '' ?></label>
        <input type="text" name="software" class="form-control" value="<?= escape($project['software'] ?? '') ?>" placeholder="Ex: VS Code, Figma, Photoshop">
    </div>

    <div class="form-group">
        <label class="form-label">Compétences (Tags)</label>
        <div class="checkbox-group">
            <?php foreach ($tags as $tag): ?>
                <label class="checkbox-item">
                    <input type="checkbox" name="competences[]" value="<?= escape($tag) ?>" <?= in_array($tag, $currentTags, true) ? 'checked' : '' ?>> <?= escape($tag) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="5"><?= escape($project['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Lien du projet (Live)</label>
        <input type="url" name="live_link" class="form-control" value="<?= escape($project['live_link'] ?? '') ?>" placeholder="https://...">
    </div>

    <div class="form-grid-two">
        <div class="form-group">
            <label class="form-label">Image de couverture</label>
            <?php if (!empty($project['image_url'])): ?>
                <div class="project-cover-preview">
                    <img src="<?= siteUrl('uploads/projects/' . $project['image_url']) ?>" class="project-cover-preview-image">
                </div>
            <?php endif; ?>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label class="form-label">Galerie (Carousel)</label>
            <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>

            <?php if (!empty($galleryImages)): ?>
                <div class="gallery-grid">
                    <?php foreach ($galleryImages as $img): ?>
                        <div class="gallery-item">
                            <img src="<?= siteUrl('uploads/projects/' . $img['image_url']) ?>">
                            <a href="<?= siteUrl('admin/projects/edit.php?id=' . $project['id'] . '&del_img=' . $img['id']) ?>" class="btn-del-img" onclick="return confirm('Supprimer cette image ?')">×</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group publish-toggle">
        <input type="checkbox" name="is_published" id="pub" <?= !empty($project['is_published']) ? 'checked' : '' ?>>
        <label for="pub"><?= empty($project['id']) ? 'Publier immédiatement' : 'Publier' ?></label>
    </div>

    <button type="submit" class="btn btn-primary"><?= escape($submitLabel) ?></button>
</form>
