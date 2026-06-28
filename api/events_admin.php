<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    $eventDate = sanitize($_POST['event_date'] ?? '');
    $eventTime = sanitize($_POST['event_time'] ?? '');
    $status = sanitize($_POST['status'] ?? 'upcoming');

    if (empty($title) || empty($eventDate)) {
        jsonResponse(['success' => false, 'error' => 'Title and date are required'], 400);
    }

    $slug = slugify($title) . '-' . time();
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $upload = uploadFile($_FILES['image'], UPLOAD_PATH . '/events');
        if ($upload['success']) $image = $upload['path'];
    }

    $db->insert('events', [
        'title' => $title,
        'slug' => $slug,
        'description' => $description,
        'location' => $location,
        'event_date' => $eventDate,
        'event_time' => $eventTime,
        'image' => $image,
        'status' => $status,
    ]);
    jsonResponse(['success' => true, 'message' => 'Event created'], 201);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);
    $event = $db->fetchOne("SELECT * FROM events WHERE id = ?", [$id]);
    if ($event && $event['image']) {
        $path = UPLOAD_PATH . '/events/' . $event['image'];
        if (file_exists($path)) unlink($path);
    }
    $db->delete('events', 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Deleted']);
}
