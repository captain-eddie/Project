<?php
session_start();

$userDataFile = 'users.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'signupEmail', FILTER_SANITIZE_EMAIL);
    $password = $_POST['signupPassword']; 

    if (!empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userData = $email . ',' . $hashedPassword . "\n";

        file_put_contents($userDataFile, $userData, FILE_APPEND);

        header("Location: login.html");
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>
