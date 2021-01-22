<?php
session_start();
require_once "../db.php";
error_reporting(-1);
$email = htmlspecialchars($_POST['email']);
$emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
$first_name = htmlspecialchars($_POST['first']);
$last_name = htmlspecialchars($_POST['last']);
$pass1 = htmlspecialchars($_POST['pass1']);
$pass2 = htmlspecialchars($_POST['pass2']);
$uniqueTime = time();
$checkImg = $_FILES['user_img']['name'];
$userTmpImg = $_FILES['user_img']['tmp_name'];
$userImg = "$uniqueTime" . $_FILES['user_img']['name'];
$regDate = date("Y-m-d");

if (empty($pass1) || empty($pass2) || empty($email) || empty($first_name) || empty($last_name)) {
    $_SESSION['undef_err'] = "Не все поля заполнены!";
    header("Location: reg.php");
} else {
    $pass1 = htmlspecialchars(md5($_POST['pass1']));
    $pass2 = htmlspecialchars(md5($_POST['pass2']));
    if ($checkImg) {
        if ($_FILES['user_img']['type'] == "image/jpeg" || $_FILES['user_img']['type'] == "image/jpg" || $_FILES['user_img']['type'] == "image/png") {
            move_uploaded_file($userTmpImg, "../user_photos/$userImg");
        } else {
            $_SESSION['file_format_err'] = "Загрузите картинку формата PNG, JPG";
            header("Location: reg.php");
        }

        $UserCheck = $db->query("SELECT * FROM users WHERE user_email='$email'");
        if ($UserCheck->rowCount() == 1) {
            $_SESSION['error'] = "Аккаунт с такой почтой уже существует!";
            header("Location: reg.php");
        } else {
            if ($pass1 === $pass2) {
                $db->query("INSERT INTO users(user_email,user_img,user_first,user_last,user_pass,create_date) VALUES ('$email','$userImg','$first_name','$last_name','$pass1','$regDate')");
                header("Location: login.php");
            } else {
                $_SESSION['error'] = "Пароли не совподают!";
                header("Location: reg.php");
            }
        }
    } else {
        $_SESSION['file_format_err'] = "Загрузите картинку формата PNG, JPG";
        header("Location: reg.php");
    }
}

if (!$emailFilter) {
    $_SESSION['email_err'] = "Почта написана не правильно";
    header("Location: reg.php");
    exit;
}
