<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'horo6346_robin_portfolio');
define('DB_USER', 'horo6346_robinportfolio'); 
define('DB_PASS', 'zqMXNferpx=o'); 

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Démarrage de session sécurisé
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true, // Mettre à false si tu testes en local sans HTTPS
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);

define('SITE_URL', 'https://robin.portfolio.robin-hourtane.fr/'); // Ton URL o2switch
?>