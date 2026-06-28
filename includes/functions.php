<?php
require_once __DIR__ . '/db.php';

function getDB() {
    return Database::getInstance();
}

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

function uploadFile($file, $targetDir, $allowedTypes = ['jpg','jpeg','png','gif','webp','mp4','webm']) {
    $targetDir = rtrim($targetDir, '/') . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedTypes)) {
        return ['success' => false, 'error' => 'File type not allowed'];
    }

    $targetPath = $targetDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Compress image if it's an image
        if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
            compressImage($targetPath, $ext, 80);
        }
        return ['success' => true, 'path' => $filename];
    }

    return ['success' => false, 'error' => 'Upload failed'];
}

function compressImage($source, $ext, $quality = 80) {
    $info = getimagesize($source);
    if ($info === false) return false;

    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $source, $quality);
            break;
        case 'png':
            $image = imagecreatefrompng($source);
            $pngQuality = 9 - round(($quality / 100) * 9);
            imagepng($image, $source, $pngQuality);
            break;
        case 'gif':
            $image = imagecreatefromgif($source);
            imagegif($image, $source);
            break;
        case 'webp':
            $image = imagecreatefromwebp($source);
            imagewebp($image, $source, $quality);
            break;
    }
    if (isset($image)) {
        imagedestroy($image);
    }
    return true;
}

function jsonResponse($data, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function isAuthenticated() {
    return isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function requireAuth() {
    if (!isAuthenticated()) {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            jsonResponse(['error' => 'Unauthorized'], 401);
        } else {
            header('Location: ' . SITE_URL . '/admin/login.php');
            exit;
        }
    }
}

function truncateText($text, $length = 100) {
    if (strlen($text) <= $length) return $text;
    return substr($text, 0, $length) . '...';
}

function formatDate($date, $format = 'F d, Y') {
    return date($format, strtotime($date));
}
