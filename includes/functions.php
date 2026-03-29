<?php
/**
 * Échappe les caractères spéciaux HTML
 */
function escape($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Redirection sécurisée
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Vérifie si la base est disponible
 */
function hasDatabase() {
    global $pdo;
    return $pdo instanceof PDO;
}

/**
 * Force la présence de la base pour les zones qui en dépendent
 */
function requireDatabase() {
    global $databaseError;

    if (hasDatabase()) {
        return;
    }

    http_response_code(500);
    $message = "La base de données n'est pas configurée pour cet environnement.";

    if (!empty($databaseError)) {
        $message .= " Détail : " . $databaseError;
    }

    die($message);
}

/**
 * Vérifie si l'admin est connecté
 */
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

/**
 * Force la connexion (à utiliser en haut des pages admin)
 */
function requireLogin() {
    requireDatabase();

    if (!isLoggedIn()) {
        redirect('/admin/login.php');
    }
}

/**
 * Génère un token CSRF
 */
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie le token CSRF
 */
function verifyCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Récupère un paramètre depuis la table settings
 */
function getSetting($key) {
    global $pdo;

    if (!hasDatabase()) {
        return null;
    }

    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    return $stmt->fetchColumn();
}

/**
 * Upload d'image sécurisé
 */
function uploadImage($file, $destination) {
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if ($file['error'] !== UPLOAD_ERR_OK) return false;
    if ($file['size'] > $maxSize) return false;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return false;

    // Vérification MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    if (!in_array($mime, $allowedMimes)) return false;

    // Renommage
    $newName = uniqid('proj_', true) . '.' . $ext;
    $target = rtrim($destination, '/') . '/' . $newName;

    if (move_uploaded_file($file['tmp_name'], $target)) {
        return $newName;
    }
    return false;
}

/**
 * Supprime une image du serveur
 */
function deleteImage($filename, $path) {
    if ($filename && file_exists($path . '/' . $filename)) {
        unlink($path . '/' . $filename);
    }
}
?>
