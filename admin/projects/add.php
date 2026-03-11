<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'])) die('Erreur CSRF');
    
    $title = trim($_POST['title']);
    $subtitle = trim($_POST['subtitle']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $type = $_POST['type'];
    $live_link = $_POST['live_link'];
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    
    // NOUVEAU : Récupération du logiciel
    $software = trim($_POST['software']);
    
    $competences = isset($_POST['competences']) ? implode(',', $_POST['competences']) : '';

    $imageFilename = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageFilename = uploadImage($_FILES['image'], '../../uploads/projects');
    }

    // NOUVEAU : Ajout de 'software' dans la requête SQL
    $sql = "INSERT INTO projects (title, subtitle, description, category, type, competences, software, live_link, is_published, image_url, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $subtitle, $description, $category, $type, $competences, $software, $live_link, $is_published, $imageFilename]);
    
    $projectId = $pdo->lastInsertId();

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
                    $pdo->prepare("INSERT INTO project_images (project_id, image_url) VALUES (?, ?)")->execute([$projectId, $galleryImg]);
                }
            }
        }
    }

    redirect('list.php?success=created');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un projet</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <style>
        .checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px; }
        .checkbox-item { background: rgba(255,255,255,0.05); padding: 5px 10px; border-radius: 4px; display: flex; align-items: center; gap: 5px; cursor: pointer; border: 1px solid var(--border); }
        .checkbox-item:hover { background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
             <div style="padding: 2rem; font-weight: bold; color: var(--text-main);">Admin Panel</div>
             <a href="list.php" class="admin-nav-item active" style="margin-top:1rem;">Retour liste</a>
        </aside>
        
        <main class="admin-content">
            <h1>Ajouter un projet</h1>
            
            <form method="POST" enctype="multipart/form-data" style="max-width: 800px;">
                <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                
                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Sous-titre</label>
                    <input type="text" name="subtitle" class="form-control">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Catégorie</label>
                        <select name="category" class="form-control">
                            <option value="pro">Projets Pro</option>
                            <option value="university">Universitaire</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control">
                            <option value="web_dev">Web Dev</option>
                            <option value="communication">Communication</option>
                            <option value="digital_creation">Créa Numérique</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Logiciels utilisés (séparés par des virgules)</label>
                    <input type="text" name="software" class="form-control" placeholder="Ex: VS Code, Figma, Photoshop">
                </div>

                <div class="form-group">
                    <label class="form-label">Compétences (Tags)</label>
                    <div class="checkbox-group">
                        <?php 
                        $tags = ["Comprendre", "Exprimer", "Concevoir", "Développer", "Entreprendre"];
                        foreach($tags as $tag): 
                        ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="competences[]" value="<?= $tag ?>"> <?= $tag ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Lien du projet (Live)</label>
                    <input type="url" name="live_link" class="form-control" placeholder="https://...">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Image de couverture</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Galerie (Carousel)</label>
                        <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                    </div>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_published" id="pub" checked>
                    <label for="pub">Publier immédiatement</label>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer le projet</button>
            </form>
        </main>
    </div>
</body>
</html>