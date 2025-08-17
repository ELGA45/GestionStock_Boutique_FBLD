<?php
// config/config.php

// Informations de base
define('APP_NAME', 'GestionStock_Boutique_FLD');
define('APP_VERSION', '1.0.0');

// URL de base (⚠️ adapte selon ton serveur)
define('BASE_URL', 'http://localhost/GestionStock_Boutique_FLD/public/');

// Chemins importants
define('ROOT_PATH', dirname(__DIR__)); // Racine du projet
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('UPLOAD_PATH', PUBLIC_PATH . '/uploads');
define('VIEW_PATH', ROOT_PATH . '/src/views');

// Base de données (⚠️ adapte à ta config MySQL)
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'gestionstock_fld');
define('DB_USER', 'root');
define('DB_PASS', '');

// Options de sécurité
define('SESSION_NAME', 'gestionstock_session');

// Activer/désactiver le debug
define('DEBUG', true);

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
