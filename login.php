<?php
session_start();
require 'db_connect.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    $hashedPassword = md5($password);

    $sql = "SELECT id,email, password FROM users WHERE email ='".$email."'";
    $sql.="and password='".$hashedPassword."'";
    $result=$conn->query($sql);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $email;

        header("Location: calendar.html");
        exit;
    } else {
        echo "Invalid email or password.";
        echo"<p> Email: $email </p>";
        echo"<p> Password: $hashedPassword </p>";
        echo"<p> $sql </p>";
        echo "<p> $id </p>";
    }
}
?>
