<?php
require_once __DIR__ . '/../includes/config.php';
if (isAuthenticated()) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit;
