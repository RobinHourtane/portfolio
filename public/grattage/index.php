<?php
declare(strict_types=1);

$sourceRoot = dirname(__DIR__, 2) . '/Grattage';
$version = '1';

if (is_file($sourceRoot . '/sketch.js')) {
    $version = (string) filemtime($sourceRoot . '/sketch.js');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="stylesheet" href="./style.php?v=<?= htmlspecialchars($version, ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
    <main aria-label="Portrait interactif à gratter"></main>

    <script src="https://cdn.jsdelivr.net/npm/p5@1.11.12/lib/p5.js"></script>
    <script src="./sketch.php?v=<?= htmlspecialchars($version, ENT_QUOTES, 'UTF-8') ?>"></script>
</body>
</html>
