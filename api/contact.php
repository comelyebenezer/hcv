<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');

    $errors = [];
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($message)) $errors[] = 'Message is required';

    if (!empty($errors)) {
        jsonResponse(['success' => false, 'error' => implode(', ', $errors)], 400);
    }

    $db->insert('contact_messages', [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'subject' => $subject,
        'message' => $message,
    ]);

    // Send email notification
    $to = ADMIN_EMAIL;
    $emailSubject = "New Contact Message from $name: $subject";
    $emailBody = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\n\nMessage:\n$message";
    @mail($to, $emailSubject, $emailBody);

    jsonResponse(['success' => true, 'message' => 'Thank you! Your message has been sent successfully.']);
}
