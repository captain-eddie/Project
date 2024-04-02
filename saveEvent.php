<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Assuming event data is sent via POST request
    $eventData = json_decode(file_get_contents('php://input'), true);
    
    // Append the new event to the session events array
    $_SESSION['events'][] = $eventData;

    echo json_encode(['status' => 'success', 'message' => 'Event added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
}
?>

