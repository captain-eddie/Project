<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    echo "<p> $email </p> <p> $password </p>";
    if (!empty($email) && !empty($password)) {
        $hashedPassword = md5($password);
        
        $sql = "INSERT INTO users (email, password) VALUES ('$email','$hashedPassword')";
        $conn->query($sql);
        
        header("Location: login.html");
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>


