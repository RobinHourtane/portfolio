<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';
requireLogin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer infos image pour suppression
    $stmt = $pdo->prepare("SELECT image_url FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    
    if ($project) {
        // Supprimer fichier physique
        if ($project['image_url']) {
            deleteImage($project['image_url'], '../../uploads/projects');
        }
        
        // Supprimer entrée BDD
        $delStmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $delStmt->execute([$id]);
    }
}

redirect('list.php?success=deleted');
?>