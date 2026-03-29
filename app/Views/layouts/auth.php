<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? escape($pageTitle) . ' - ' : '' ?>Portfolio</title>
    <link rel="stylesheet" href="<?= assetUrl('assets/css/admin.css') ?>">
</head>
<body class="login-wrapper">
<?= $content ?>
</body>
</html>
