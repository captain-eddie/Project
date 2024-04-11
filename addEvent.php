<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $notes = $_POST['notes'];


    if (!empty($user_id) && !empty($date) && !empty($name) && !empty($location) && !empty($notes)) {
        
        $sql = "INSERT INTO events (user_id, date, name, location, notes) VALUES ('$user_id', '$date','$name','$location','$notes')";
        $conn->query($sql);

        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>