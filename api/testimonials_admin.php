<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $position = sanitize($_POST['position'] ?? '');
    $content = sanitize($_POST['content'] ?? '');
    $featured = isset($_POST['featured']) ? 1 : 0;

    if (empty($name) || empty($content)) {
        jsonResponse(['success' => false, 'error' => 'Name and content required'], 400);
    }

    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $upload = uploadFile($_FILES['photo'], UPLOAD_PATH . '/gallery');
        if ($upload['success']) $photo = $upload['path'];
    }

    $db->insert('testimonials', [
        'name' => $name,
        'position' => $position,
        'photo' => $photo,
        'content' => $content,
        'featured' => $featured,
    ]);
    jsonResponse(['success' => true, 'message' => 'Testimonial added'], 201);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);
    $item = $db->fetchOne("SELECT * FROM testimonials WHERE id = ?", [$id]);
    if ($item && $item['photo']) {
        $path = UPLOAD_PATH . '/gallery/' . $item['photo'];
        if (file_exists($path)) unlink($path);
    }
    $db->delete('testimonials', 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Deleted']);
}
