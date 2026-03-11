<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "contactez_moi";
$messageSent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validation basique
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Tous les champs sont requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format d'email invalide.";
    } else {
        // Insertion BDD
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $email, $subject, $message]);
            
            // Envoi mail (fonction native PHP mail(), à configurer sur o2switch si besoin)
            $to = getSetting('email');
            $headers = "From: " . $email;
            mail($to, "Nouveau message de $name : $subject", $message, $headers);

            $messageSent = true;
        } catch (Exception $e) {
            $error = "Erreur lors de l'envoi : " . $e->getMessage();
        }
    }
}

require_once 'includes/header.php';
?>

<div class="container flex-center" style="min-height: calc(100vh - 100px); padding-top: 55px;">
    
    <div class="contact-container" style="width: 100%; max-width: 600px;">
        <h1 style="text-align: center; margin-bottom: 2rem; color: var(--text-main);">_contactez_moi</h1>
        
        <?php if ($messageSent): ?>
            <div class="alert alert-success" style="padding: 1rem; background: rgba(67, 217, 173, 0.1); border: 1px solid var(--accent-turquoise); color: var(--text-main); text-align: center;">
                <h3 style="color: var(--accent-turquoise);">Message envoyé ! 🚀</h3>
                <p>Merci <?= escape($name) ?>, je vous répondrai très vite.</p>
                <a href="index.php" class="btn" style="margin-top: 1rem;">Retour accueil</a>
            </div>
        <?php else: ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger" style="color: var(--accent-rose); margin-bottom: 1rem;"><?= $error ?></div>
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

<?php require_once 'includes/footer.php'; ?>