<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $partners = $db->fetchAll("SELECT * FROM partners ORDER BY display_order ASC, name ASC");
    jsonResponse(['success' => true, 'data' => $partners]);
}
