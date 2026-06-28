<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id) {
        $post = $db->fetchOne("SELECT * FROM blog_posts WHERE id = ?", [$id]);
        jsonResponse(['success' => true, 'data' => $post]);
    }
    $posts = $db->fetchAll("SELECT * FROM blog_posts ORDER BY created_at DESC");
    jsonResponse(['success' => true, 'data' => $posts]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $content = $_POST['content'] ?? '';
    $excerpt = sanitize($_POST['excerpt'] ?? '');
    $category = sanitize($_POST['category'] ?? 'Uncategorized');
    $author = sanitize($_POST['author'] ?? 'HCV');
    $featured = isset($_POST['featured']) ? 1 : 0;
    $status = sanitize($_POST['status'] ?? 'published');

    if (empty($title) || empty($content)) {
        jsonResponse(['success' => false, 'error' => 'Title and content are required'], 400);
    }

    $slug = slugify($title);
    $featuredImage = '';

    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === 0) {
        $upload = uploadFile($_FILES['featured_image'], UPLOAD_PATH . '/blog');
        if ($upload['success']) {
            $featuredImage = $upload['path'];
        }
    }

    try {
        $db->insert('blog_posts', [
            'title' => $title,
            'slug' => $slug . '-' . time(),
            'excerpt' => $excerpt ?: substr(strip_tags($content), 0, 150),
            'content' => $content,
            'category' => $category,
            'featured_image' => $featuredImage,
            'featured' => $featured,
            'status' => $status,
            'author' => $author,
        ]);
        jsonResponse(['success' => true, 'message' => 'Post created successfully'], 201);
    } catch (Exception $e) {
        jsonResponse(['success' => false, 'error' => 'Failed to create post'], 500);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success' => false, 'error' => 'ID required'], 400);
    
    $post = $db->fetchOne("SELECT * FROM blog_posts WHERE id = ?", [$id]);
    if ($post && $post['featured_image']) {
        $path = UPLOAD_PATH . '/blog/' . $post['featured_image'];
        if (file_exists($path)) unlink($path);
    }
    $db->delete('blog_posts', 'id = ?', [$id]);
    jsonResponse(['success' => true, 'message' => 'Deleted']);
}
