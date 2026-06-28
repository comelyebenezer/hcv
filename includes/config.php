<?php
// HCV Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'hcv_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('SITE_NAME', 'Health Communication and Visibility');
define('SITE_URL', 'http://localhost/hcv');
define('UPLOAD_PATH', __DIR__ . '/../assets/uploads');
define('UPLOAD_URL', SITE_URL . '/assets/uploads');

define('ADMIN_EMAIL', 'admin@hcv.org');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
