<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $info = $db->fetchOne("SELECT * FROM contact_info ORDER BY id DESC LIMIT 1");
    jsonResponse(['success' => true, 'data' => $info]);
}
