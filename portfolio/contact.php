<?php
require 'db.php';

// Set content type to JSON
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
    $subject = isset($data['subject']) ? $data['subject'] : '';
    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$data['name'], $data['email'], $subject, $data['message']]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing fields']);
}
?>