<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $items = $db->fetchAll("SELECT * FROM gallery ORDER BY created_at DESC");
    jsonResponse(['success' => true, 'data' => $items]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $category = sanitize($_POST['category'] ?? 'uncategorized');
    $type = sanitize($_POST['type'] ?? 'image');
    $videoUrl = sanitize($_POST['video_url'] ?? '');
    $featured = isset($_POST['featured']) ? 1 : 0;

    if (empty($title)) {
        jsonResponse(['success' => false, 'error' => 'Title is required'], 400);
    }

    $filePath = '';
    $thumbnail = '';

    if ($type === 'image' && isset($_FILES['file'])) {
        $upload = uploadFile($_FILES['file'], UPLOAD_PATH . '/gallery');
        if (!$upload['success']) {
            jsonResponse(['success' => false, 'error' => $upload['error']], 400);
        }
        $filePath = $upload['path'];
    } elseif ($type === 'video') {
        if (!empty($videoUrl)) {
            // YouTube/Vimeo embed - store URL
            if (isset($_FILES['thumbnail'])) {
                $thumbUpload = uploadFile($_FILES['thumbnail'], UPLOAD_PATH . '/gallery');
                if ($thumbUpload['success']) {
                    $thumbnail = $thumbUpload['path'];
                }
            }
            $filePath = $videoUrl;
        } elseif (isset($_FILES['file'])) {
            $upload = uploadFile($_FILES['file'], UPLOAD_PATH . '/gallery', ['jpg','jpeg','png','gif','webp','mp4','webm','avi','mov']);
            if (!$upload['success']) {
                jsonResponse(['success' => false, 'error' => $upload['error']], 400);
            }
            $filePath = $upload['path'];
        }
    }

    if (empty($filePath) && $type === 'image') {
        jsonResponse(['success' => false, 'error' => 'File is required'], 400);
    }

    $data = [
        'title' => $title,
        'type' => $type,
        'category' => $category,
        'file_path' => $filePath,
        'thumbnail' => $thumbnail,
        'video_url' => $videoUrl,
        'featured' => $featured,
    ];

    $id = $db->insert('gallery', $data);
    $data['id'] = $id;
    jsonResponse(['success' => true, 'data' => $data, 'message' => 'Media added successfully'], 201);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = (int)($_GET['id'] ?? $_DELETE['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);

    $item = $db->fetchOne("SELECT * FROM gallery WHERE id = ?", [$id]);
    if ($item) {
        $filePath = UPLOAD_PATH . '/gallery/' . $item['file_path'];
        if (file_exists($filePath)) unlink($filePath);
        if ($item['thumbnail']) {
            $thumbPath = UPLOAD_PATH . '/gallery/' . $item['thumbnail'];
            if (file_exists($thumbPath)) unlink($thumbPath);
        }
    }
    $db->delete('gallery', 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Deleted successfully']);
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents('php://input'), $_PUT);
    $id = (int)($_GET['id'] ?? $_PUT['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);

    $data = [];
    if (!empty($_PUT['title'])) $data['title'] = sanitize($_PUT['title']);
    if (!empty($_PUT['category'])) $data['category'] = sanitize($_PUT['category']);
    if (isset($_PUT['featured'])) $data['featured'] = (int)$_PUT['featured'];

    if (!empty($data)) {
        $db->update('gallery', $data, 'id = ?', [$id]);
    }
    jsonResponse(['success' => true, 'message' => 'Updated successfully']);
}
