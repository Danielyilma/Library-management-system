<?php

$config = require 'Core/config.php';
$conn = new Database($config);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email'])){
        $email = $_POST["email"];
        $query = "SELECT id FROM users WHERE email = :email";

        $user = $conn->query($query, ['email' => $email])->fetch();

        if (!$user) {
            return "user not Found";
        }

        $token = bin2hex(random_bytes(50));
        $expires = date("U") + 1800;

        $query1 = "DELETE FROM password_resets WHERE email = :email";
        $conn->query($query1, ['email' => $email]);

        $query2 = "INSERT INTO password_resets (email, token, expires) VALUES (:email, :token, :expires)";
        $conn->query($query2, ['email' => $email, 'token' => $token, 'expires' => $expires]);

        $resetLink = "http://localhost:8000/reset_password?token=". $token;
        
        require "mail.php";
        $mail = new Mail();
        $mail->sender("daniel.yilma@aastustudent.edu.et", "12345678");
        $mail->reciever($email);
        $mail->set_email("Password Reset Request", "Click the following link to reset your password: " . $resetLink);
        $mail->send();

    } else {
        $new_password = $_POST['password'];
        $confirm_password = $_POST['psame'];

        if ($new_password != $confirm_password) {
            return "Passwords do not match.";
        }

        $token = $_POST['token'];
        $query3 = "SELECT * FROM password_resets WHERE token = :token AND expires >= :now";
        $reset = $conn->query($query3, ['token' => $token, 'now' => date("U")])->fetch();

        if (!$reset) {
            return "Invalid or expired token.";
        }
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        $query4 = "UPDATE users SET password =:password WHERE email = :email";
        $stmt = $conn->query($query4, ['password' => $hashed_password, 'email' => $reset['email']]);
        $query1 = "DELETE FROM password_resets WHERE email = :email";
        $conn->query($query1, ['email' => $email]);
        Header("Location: /login");
        exit();
    }
} else {
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $query3 = "SELECT * FROM password_resets WHERE token = :token AND expires >= :now";
        $reset = $conn->query($query3, ['token' => $token, 'now' => date("U")])->fetch();

        if (!$reset) {
            return "Invalid or expired token.";
        }

        $password_reset = True;
    }
}

require "views/forgot_password.php";