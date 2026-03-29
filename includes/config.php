<?php
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

if (!defined('APP_PATH')) {
    define('APP_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'app');
}

if (!defined('PUBLIC_PATH')) {
    define('PUBLIC_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'public');
}

if (!defined('PROJECT_UPLOADS_PATH')) {
    define('PROJECT_UPLOADS_PATH', PUBLIC_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'projects');
}

if (!defined('SETTINGS_UPLOADS_PATH')) {
    define('SETTINGS_UPLOADS_PATH', PUBLIC_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'settings');
}

$getEnv = static function (string $key): ?string {
    $value = getenv($key);
    return $value === false ? null : $value;
};

$parseBool = static function ($value, ?bool $default = null): ?bool {
    if ($value === null) {
        return $default;
    }

    if (is_bool($value)) {
        return $value;
    }

    $normalized = strtolower(trim((string) $value));

    if (in_array($normalized, ['1', 'true', 'yes', 'on'], true)) {
        return true;
    }

    if (in_array($normalized, ['0', 'false', 'no', 'off'], true)) {
        return false;
    }

    return $default;
};

$requestHost = strtolower((string) ($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? ''));
$requestHost = explode(':', $requestHost)[0];
$isLocalHost = in_array($requestHost, ['localhost', '127.0.0.1', '::1'], true);
$isCli = PHP_SAPI === 'cli';
$isHttps = !$isCli && (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
    || (int) ($_SERVER['SERVER_PORT'] ?? 0) === 443
);

$config = [
    'db_host' => 'localhost',
    'db_port' => '',
    'db_name' => 'horo6346_robin_portfolio',
    'db_user' => 'horo6346_robinportfolio',
    'db_pass' => 'zqMXNferpx=o',
    'site_url' => 'https://robin-hourtane.fr/',
    'cookie_secure' => null,
    'allow_local_without_db' => true,
];

$localConfigFile = __DIR__ . '/config.local.php';
if (is_file($localConfigFile)) {
    $localConfig = require $localConfigFile;
    if (is_array($localConfig)) {
        $config = array_replace($config, $localConfig);
    }
}

$envConfig = [
    'db_host' => $getEnv('PORTFOLIO_DB_HOST'),
    'db_port' => $getEnv('PORTFOLIO_DB_PORT'),
    'db_name' => $getEnv('PORTFOLIO_DB_NAME'),
    'db_user' => $getEnv('PORTFOLIO_DB_USER'),
    'db_pass' => $getEnv('PORTFOLIO_DB_PASS'),
    'site_url' => $getEnv('PORTFOLIO_SITE_URL'),
];

foreach ($envConfig as $key => $value) {
    if ($value !== null) {
        $config[$key] = $value;
    }
}

$cookieSecureOverride = $parseBool($getEnv('PORTFOLIO_COOKIE_SECURE'));
if ($cookieSecureOverride !== null) {
    $config['cookie_secure'] = $cookieSecureOverride;
}

$allowLocalWithoutDbOverride = $parseBool($getEnv('PORTFOLIO_ALLOW_LOCAL_WITHOUT_DB'));
if ($allowLocalWithoutDbOverride !== null) {
    $config['allow_local_without_db'] = $allowLocalWithoutDbOverride;
}

define('DB_HOST', (string) $config['db_host']);
define('DB_PORT', (string) ($config['db_port'] ?? ''));
define('DB_NAME', (string) $config['db_name']);
define('DB_USER', (string) $config['db_user']);
define('DB_PASS', (string) $config['db_pass']);

$pdo = null;
$databaseError = null;
$dsnParts = ['host=' . DB_HOST];

if (DB_PORT !== '') {
    $dsnParts[] = 'port=' . DB_PORT;
}

$dsnParts[] = 'dbname=' . DB_NAME;
$dsnParts[] = 'charset=utf8mb4';

try {
    $pdo = new PDO('mysql:' . implode(';', $dsnParts), DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $databaseError = $e->getMessage();
    $allowLocalWithoutDb = $parseBool($config['allow_local_without_db'], true);

    if (!$isCli && !($isLocalHost && $allowLocalWithoutDb)) {
        die('Erreur de connexion : ' . $databaseError);
    }
}

$cookieSecure = $config['cookie_secure'];
if ($cookieSecure === null) {
    $cookieSecure = $isHttps;
}

session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => (bool) $cookieSecure,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);

$defaultSiteUrl = 'https://robin-hourtane.fr/';
if ($isLocalHost && !$isCli) {
    $scheme = $isHttps ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? '127.0.0.1';
    $defaultSiteUrl = $scheme . '://' . $host . '/';
}

$siteUrl = (string) ($config['site_url'] ?: $defaultSiteUrl);
define('SITE_URL', rtrim($siteUrl, '/') . '/');
?>
