<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        jsonResponse(['success' => false, 'error' => 'Username and password required'], 400);
    }

    $user = $db->fetchOne("SELECT * FROM users WHERE username = ? OR email = ?", [$username, $username]);

    if (!$user || !password_verify($password, $user['password'])) {
        jsonResponse(['success' => false, 'error' => 'Invalid credentials'], 401);
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['logged_in'] = true;

    jsonResponse(['success' => true, 'message' => 'Login successful', 'user' => [
        'id' => $user['id'],
        'username' => $user['username'],
        'role' => $user['role'],
    ]]);
}
