<?php
require_once __DIR__ . '/../includes/functions.php';
requireAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bankName = sanitize($_POST['bank_name'] ?? '');
    $accountName = sanitize($_POST['account_name'] ?? '');
    $accountNumber = sanitize($_POST['account_number'] ?? '');

    if (empty($bankName) || empty($accountName) || empty($accountNumber)) {
        jsonResponse(['success' => false, 'error' => 'All fields required'], 400);
    }

    $existing = $db->fetchOne("SELECT id FROM donation_info ORDER BY id DESC LIMIT 1");
    if ($existing) {
        $db->update('donation_info', [
            'bank_name' => $bankName,
            'account_name' => $accountName,
            'account_number' => $accountNumber,
        ], 'id = ?', [$existing['id']]);
    } else {
        $db->insert('donation_info', [
            'bank_name' => $bankName,
            'account_name' => $accountName,
            'account_number' => $accountNumber,
        ]);
    }
    jsonResponse(['success' => true, 'message' => 'Donation info updated successfully']);
}
