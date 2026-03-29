<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireDatabase();

// Si déjà connecté, redirection dashboard
if (isLoggedIn()) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Création session
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_user'] = $user['username'];
            
            // Régénération ID session pour éviter fixation
            session_regenerate_id(true);
            
            redirect('index.php');
        } else {
            $error = "Identifiants incorrects.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portfolio</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="login-wrapper">
    <div class="login-box">
        <h2 style="color: var(--text-main); text-align: center; margin-bottom: 2rem;">_admin_access</h2>
        
        <?php if($error): ?>
            <div class="alert alert-danger"><?= escape($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 1rem;">
                <label style="color: var(--text-secondary);">User</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="color: var(--text-secondary);">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
