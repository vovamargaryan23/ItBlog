<?php
session_start();
require_once "../db.php";
$email = htmlspecialchars($_POST['email']);
$emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
$first_name = htmlspecialchars($_POST['first']);
$last_name = htmlspecialchars($_POST['last']);
$pass = htmlspecialchars(md5($_POST['pass']));
if ($emailFilter == false) {
    $_SESSION['email_err'] = "Почта написана не правильно";
    header("Location: login.php");
    exit;
}
if (empty($email) || empty($pass)) {
    $_SESSION['error'] = "Введите Данные!";
    header("Location: login.php");
} else {
    $conn = $db->prepare("SELECT * FROM users WHERE user_email=:email AND user_pass=:pass");
    $conn->execute([
        "email" => $email,
        "pass" => $pass
    ]);
    if ($conn->rowCount() == 1) {
        $user = $conn->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = [
            'user_id' => $user['user_id'],
            'first_name' => $user['user_first'],
            'last_name' => $user['user_last'],
            'user_img' => $user['user_img']
        ];
        header("Location: ../index.php");
    } else {
        $_SESSION['error'] = "Введены неправильные данные!";
        header("Location: login.php");
    }
}
