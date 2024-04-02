<?php
// Assuming data is sent using POST as JSON
$content = file_get_contents("php://input");
$eventData = json_decode($content, true);

// File to store event data
$eventsFile = 'events.txt';

// Basic validation to check if necessary information is present
if (!empty($eventData['date']) && !empty($eventData['name']) && !empty($eventData['userEmail'])) {
    // Prepare the string to write to the file
    $eventString = $eventData['userEmail'] . ',' . $eventData['date'] . ',' . $eventData['name'] . ',' . $eventData['location'] . ',' . $eventData['notes'] . "\n";

    // Append the event data to the file
    file_put_contents($eventsFile, $eventString, FILE_APPEND);

    // Send a success response
    echo json_encode(['status' => 'success', 'message' => 'Event added successfully.']);
} else {
    // Send an error response
    echo json_encode(['status' => 'error', 'message' => 'Missing required event details.']);
}
