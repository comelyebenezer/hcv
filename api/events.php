<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $events = $db->fetchAll(
        "SELECT id, title, description, location, event_date, event_time, image, status 
         FROM events WHERE status IN ('upcoming','ongoing') 
         ORDER BY event_date ASC"
    );
    jsonResponse(['success' => true, 'data' => $events]);
}
