<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents('php://input'), $_PUT);
    $id = (int)($_PUT['id'] ?? 0);
    $readStatus = (int)($_PUT['read_status'] ?? 1);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);
    $db->update('contact_messages', ['read_status' => $readStatus], 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Updated']);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);
    $db->delete('contact_messages', 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Deleted']);
}
