<?php
session_start();

$userDataFile = 'users.txt';

$users = [];
if (file_exists($userDataFile)) {
    $lines = file($userDataFile, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($email, $hashedPassword) = explode(',', $line);
        $users[] = ['email' => $email, 'password' => $hashedPassword];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    foreach ($users as $user) {
        if ($user['email'] == $email && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            //  this is redirect stuff and things
            header("Location: calendar.html");
            exit;
        }
    }

    echo "Invalid email or password";
}
?>
