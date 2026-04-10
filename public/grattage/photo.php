<?php
declare(strict_types=1);

$source = dirname(__DIR__, 2) . '/Grattage/photo_Robin.png';

if (!is_file($source)) {
    http_response_code(404);
    exit;
}

header('Content-Type: image/png');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

readfile($source);
