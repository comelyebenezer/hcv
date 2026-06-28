<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = sanitize($input['email'] ?? $_POST['email'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['success' => false, 'error' => 'Valid email is required'], 400);
    }

    try {
        $db->insert('newsletter_subscribers', ['email' => $email]);
        jsonResponse(['success' => true, 'message' => 'Successfully subscribed!']);
    } catch (Exception $e) {
        jsonResponse(['success' => false, 'error' => 'This email is already subscribed.']);
    }
}
