<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';
requireLogin();

if (!isset($_GET['id'])) redirect('list.php');
$id = $_GET['id'];

if (isset($_GET['del_img'])) {
    $imgId = $_GET['del_img'];
    $stmt = $pdo->prepare("SELECT image_url FROM project_images WHERE id = ? AND project_id = ?");
    $stmt->execute([$imgId, $id]);
    $img = $stmt->fetch();
    if ($img) {
        deleteImage($img['image_url'], '../../uploads/projects');
        $pdo->prepare("DELETE FROM project_images WHERE id = ?")->execute([$imgId]);
    }
    redirect("edit.php?id=$id");
}

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();
$stmtImgs = $pdo->prepare("SELECT * FROM project_images WHERE project_id = ?");
$stmtImgs->execute([$id]);
$galleryImages = $stmtImgs->fetchAll();

if (!$project) redirect('list.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'])) die('Erreur CSRF');

    $title = trim($_POST['title']);
    $subtitle = trim($_POST['subtitle']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $type = $_POST['type'];
    $live_link = $_POST['live_link'];
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    
    // NOUVEAU : Récupération software
    $software = trim($_POST['software']);
    
    $competences = isset($_POST['competences']) ? implode(',', $_POST['competences']) : '';
    
    $imageFilename = $project['image_url'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $newImg = uploadImage($_FILES['image'], '../../uploads/projects');
        if ($newImg) {
            if ($project['image_url']) deleteImage($project['image_url'], '../../uploads/projects');
            $imageFilename = $newImg;
        }
    }

    // NOUVEAU : Update incluant software
    $sql = "UPDATE projects SET title=?, subtitle=?, description=?, category=?, type=?, competences=?, software=?, live_link=?, is_published=?, image_url=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $subtitle, $description, $category, $type, $competences, $software, $live_link, $is_published, $imageFilename, $id]);

    if (isset($_FILES['gallery'])) {
        $count = count($_FILES['gallery']['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($_FILES['gallery']['error'][$i] === 0) {
                $file = [
                    'name' => $_FILES['gallery']['name'][$i],
                    'type' => $_FILES['gallery']['type'][$i],
                    'tmp_name' => $_FILES['gallery']['tmp_name'][$i],
                    'error' => $_FILES['gallery']['error'][$i],
                    'size' => $_FILES['gallery']['size'][$i]
                ];
                $galleryImg = uploadImage($file, '../../uploads/projects');
                if ($galleryImg) {
                    $pdo->prepare("INSERT INTO project_images (project_id, image_url) VALUES (?, ?)")->execute([$id, $galleryImg]);
                }
            }
        }
    }

    redirect("edit.php?id=$id&success=updated");
}

$currentTags = explode(',', $project['competences'] ?? '');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier projet</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <style>
        .checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px; }
        .checkbox-item { background: rgba(255,255,255,0.05); padding: 5px 10px; border-radius: 4px; display: flex; align-items: center; gap: 5px; cursor: pointer; border: 1px solid var(--border); }
        .checkbox-item:hover { background: rgba(255,255,255,0.1); }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin-top: 10px; }
        .gallery-item { position: relative; border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
        .gallery-item img { width: 100%; height: 80px; object-fit: cover; display: block; }
        .btn-del-img { position: absolute; top: 2px; right: 2px; background: red; color: white; border: none; width: 20px; height: 20px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 12px; text-decoration: none;}
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
             <div style="padding: 2rem; font-weight: bold; color: var(--text-main);">Admin Panel</div>
             <a href="list.php" class="admin-nav-item active" style="margin-top:1rem;">Retour liste</a>
        </aside>
        
        <main class="admin-content">
            <h1>Modifier : <?= escape($project['title']) ?></h1>
            
            <form method="POST" enctype="multipart/form-data" style="max-width: 800px;">
                <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="title" class="form-control" value="<?= escape($project['title']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Sous-titre</label>
                    <input type="text" name="subtitle" class="form-control" value="<?= escape($project['subtitle']) ?>">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Catégorie</label>
                        <select name="category" class="form-control">
                            <option value="pro" <?= $project['category'] == 'pro' ? 'selected' : '' ?>>Projets Pro</option>
                            <option value="university" <?= $project['category'] == 'university' ? 'selected' : '' ?>>Universitaire</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control">
                            <option value="web_dev" <?= $project['type'] == 'web_dev' ? 'selected' : '' ?>>Web Dev</option>
                            <option value="communication" <?= $project['type'] == 'communication' ? 'selected' : '' ?>>Communication</option>
                            <option value="digital_creation" <?= $project['type'] == 'digital_creation' ? 'selected' : '' ?>>Créa Numérique</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Logiciels utilisés</label>
                    <input type="text" name="software" class="form-control" value="<?= escape($project['software']) ?>" placeholder="Ex: VS Code, Figma, Photoshop">
                </div>

                <div class="form-group">
                    <label class="form-label">Compétences (Tags)</label>
                    <div class="checkbox-group">
                        <?php 
                        $tags = ["Comprendre", "Exprimer", "Concevoir", "Développer", "Entreprendre"];
                        foreach($tags as $tag): 
                            $checked = in_array($tag, $currentTags) ? 'checked' : '';
                        ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="competences[]" value="<?= $tag ?>" <?= $checked ?>> <?= $tag ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"><?= escape($project['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Lien Live</label>
                    <input type="url" name="live_link" class="form-control" value="<?= escape($project['live_link']) ?>">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Image Cover</label>
                        <?php if($project['image_url']): ?>
                            <div style="margin-bottom: 0.5rem;">
                                <img src="../../uploads/projects/<?= escape($project['image_url']) ?>" style="height: 100px; border-radius: 4px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ajouter à la Galerie</label>
                        <input type="file" name="gallery[]" class="form-control" multiple>
                        <div class="gallery-grid">
                            <?php foreach($galleryImages as $img): ?>
                                <div class="gallery-item">
                                    <img src="../../uploads/projects/<?= escape($img['image_url']) ?>">
                                    <a href="?id=<?= $id ?>&del_img=<?= $img['id'] ?>" class="btn-del-img" onclick="return confirm('Supprimer cette image ?')">×</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="is_published" id="pub" <?= $project['is_published'] ? 'checked' : '' ?>>
                    <label for="pub">Publier</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </main>
    </div>
</body>
</html>