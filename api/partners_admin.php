<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $category = sanitize($_POST['category'] ?? 'partner');
    $website = sanitize($_POST['website'] ?? '');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    if (empty($name)) {
        jsonResponse(['success' => false, 'error' => 'Name required'], 400);
    }

    if (!isset($_FILES['logo']) || $_FILES['logo']['error'] !== 0) {
        jsonResponse(['success' => false, 'error' => 'Logo required'], 400);
    }

    $upload = uploadFile($_FILES['logo'], UPLOAD_PATH . '/partners');
    if (!$upload['success']) {
        jsonResponse(['success' => false, 'error' => $upload['error']], 400);
    }

    $db->insert('partners', [
        'name' => $name,
        'logo' => $upload['path'],
        'website' => $website,
        'category' => $category,
        'display_order' => $displayOrder,
    ]);
    jsonResponse(['success' => true, 'message' => 'Partner added'], 201);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);
    $item = $db->fetchOne("SELECT * FROM partners WHERE id = ?", [$id]);
    if ($item && $item['logo']) {
        $path = UPLOAD_PATH . '/partners/' . $item['logo'];
        if (file_exists($path)) unlink($path);
    }
    $db->delete('partners', 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Deleted']);
}
