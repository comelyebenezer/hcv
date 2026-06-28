<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $items = $db->fetchAll("SELECT * FROM testimonials ORDER BY featured DESC, created_at DESC");
    jsonResponse(['success' => true, 'data' => $items]);
}
