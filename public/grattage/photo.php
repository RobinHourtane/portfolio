<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/app/bootstrap.php';

$settings = new \App\Models\SettingModel();
$source = \scratchImagePath($settings->get('scratch_image', ''));

if ($source === null || !is_file($source)) {
    http_response_code(404);
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = $finfo ? finfo_file($finfo, $source) : false;

if ($finfo) {
    finfo_close($finfo);
}

header('Content-Type: ' . ($mime ?: 'application/octet-stream'));
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

readfile($source);
