<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $limit = (int)($_GET['limit'] ?? 6);
    $posts = $db->fetchAll(
        "SELECT id, title, slug, excerpt, category, featured_image, featured, author, created_at 
         FROM blog_posts WHERE status = 'published' 
         ORDER BY featured DESC, created_at DESC LIMIT ?", 
        [$limit]
    );
    jsonResponse(['success' => true, 'data' => $posts]);
}
