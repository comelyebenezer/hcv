<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['address', 'phone', 'email', 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
    $data = [];
    foreach ($fields as $field) {
        $data[$field] = sanitize($_POST[$field] ?? '');
    }

    $existing = $db->fetchOne("SELECT id FROM contact_info ORDER BY id DESC LIMIT 1");
    if ($existing) {
        $db->update('contact_info', $data, 'id = ?', [$existing['id']]);
    } else {
        $db->insert('contact_info', $data);
    }
    jsonResponse(['success' => true, 'message' => 'Contact info updated successfully']);
}
