<?php
declare(strict_types=1);

$source = dirname(__DIR__, 2) . '/Grattage/style.css';

if (!is_file($source)) {
    http_response_code(404);
    exit;
}

header('Content-Type: text/css; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

readfile($source);
