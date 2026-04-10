<?php
declare(strict_types=1);

$source = dirname(__DIR__, 2) . '/Grattage/sketch.js';

if (!is_file($source)) {
    http_response_code(404);
    exit;
}

$script = file_get_contents($source);

if ($script === false) {
    http_response_code(500);
    exit;
}

$script = str_replace('photo_Robin.png', 'photo.php', $script);

header('Content-Type: application/javascript; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

echo $script;
