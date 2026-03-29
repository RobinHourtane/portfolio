<style>
    .checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px; }
    .checkbox-item { background: rgba(255,255,255,0.05); padding: 5px 10px; border-radius: 4px; display: flex; align-items: center; gap: 5px; cursor: pointer; border: 1px solid var(--border); }
    .checkbox-item:hover { background: rgba(255,255,255,0.1); }
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin-top: 10px; }
    .gallery-item { position: relative; border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
    .gallery-item img { width: 100%; height: 80px; object-fit: cover; display: block; }
    .btn-del-img { position: absolute; top: 2px; right: 2px; background: red; color: white; border: none; width: 20px; height: 20px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 12px; text-decoration: none; }
</style>

<h1><?= escape($heading) ?></h1>

<?php if ($success): ?>
    <div class="alert alert-success" style="margin-top: 1rem;">Projet mis à jour.</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" action="<?= $formAction ?>" style="max-width: 800px;">
    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

    <div class="form-group">
        <label class="form-label">Titre *</label>
        <input type="text" name="title" class="form-control" value="<?= escape($project['title'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Sous-titre</label>
        <input type="text" name="subtitle" class="form-control" value="<?= escape($project['subtitle'] ?? '') ?>">
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
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

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="form-group">
            <label class="form-label">Image de couverture</label>
            <?php if (!empty($project['image_url'])): ?>
                <div style="margin-bottom: 0.5rem;">
                    <img src="<?= siteUrl('uploads/projects/' . $project['image_url']) ?>" style="height: 100px; border-radius: 4px;">
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

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
        <input type="checkbox" name="is_published" id="pub" <?= !empty($project['is_published']) ? 'checked' : '' ?>>
        <label for="pub"><?= empty($project['id']) ? 'Publier immédiatement' : 'Publier' ?></label>
    </div>

    <button type="submit" class="btn btn-primary"><?= escape($submitLabel) ?></button>
</form>
