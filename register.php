<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, $_POST['registerEmail'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['registerPassword'];
    echo "<p> $email </p> <p> $password </p>";
    if (!empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (email, password) VALUES ('$email','$password')";
        $conn->query($sql);
        /*
        try {
            ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss",$email,$password);
            $stmt->execute([$email, $hashedPassword]);
            header("Location: login.html");
            exit;
        } catch (mysqli_sql_exception $e){
            die("Error: " . $e->getMessage());
        }*/
    } else {
        echo "Please fill in all fields.";
    }
}
?>


