<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? escape($pageTitle) . ' - ' : '' ?>Admin</title>
    <link rel="stylesheet" href="<?= assetUrl('assets/css/admin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="admin-layout">
    <?php require APP_PATH . '/Views/partials/admin_sidebar.php'; ?>
    <main class="admin-content">
        <?= $content ?>
    </main>
</div>
</body>
</html>
