<?php
session_start();
require 'db_connect.php'; 

$content = file_get_contents("php://input");
$eventData = json_decode($content, true);

if (!empty($eventData['date']) && !empty($eventData['name']) && !empty($eventData['userEmail'])) {
    // Find user_id based on userEmail
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$eventData['userEmail']]);
    $user = $stmt->fetch();
    
    if ($user) {
        $sql = "INSERT INTO events (user_id, date, name, location, notes) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute([$user['id'], $eventData['date'], $eventData['name'], $eventData['location'], $eventData['notes']]);
            echo json_encode(['status' => 'success', 'message' => 'Event added successfully.']);
            exit;
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required event details.']);
}
?>

