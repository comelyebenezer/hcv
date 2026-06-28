<?php
require_once __DIR__ . '/functions.php';

function checkAuth() {
    if (!isAuthenticated()) {
        header('Location: ' . SITE_URL . '/admin/login.php');
        exit;
    }
}
