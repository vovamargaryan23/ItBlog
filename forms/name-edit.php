<?php
session_start();
require_once "../db.php";
$uniqueTime = time();
$checkImg = $_FILES['user_update_img'];
$userTmpImg = $_FILES['user_update_img']['tmp_name'];
$userImg = "$uniqueTime" . $_FILES['user_update_img']['name'];
$new_first = $_POST['edit_first'];
$new_last = $_POST['edit_last'];
$user_id = $_SESSION['user']['user_id'];

if (isset($_POST['acc_change_sub'])) {
    if (isset($_FILES['user_update_img']['name'])) {
        if ($_FILES['user_update_img']['type'] == "image/jpeg" || $_FILES['user_update_img']['type'] == "image/jpg" || $_FILES['user_update_img']['type'] == "image/png") {
            move_uploaded_file($userTmpImg, "../user_photos/$userImg");
            $delUserQuery = $db->query("SELECT user_img FROM users WHERE user_id='$user_id'");
            $delUserImg = $delUserQuery->fetch(PDO::FETCH_ASSOC);
            unlink("../user_photos/" . $delUserImg['user_img']);
            $edit_req = $db->prepare("UPDATE users SET user_first=:first,user_last=:last, user_img=:img WHERE user_id=:user_id");
            $edit_req->execute([
                "first" => $new_first,
                "last" => $new_last,
                "user_id" => $user_id,
                "img" => $userImg
            ]);
            $_SESSION['edit_success'] = "Перезайдите в аккаунт чтобы изменения были видны!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } elseif (isset($_FILES['user_update_img']) && $_FILES['user_update_img']['type'] == "image/jpeg" || $_FILES['user_update_img']['type'] == "image/jpg" || $_FILES['user_update_img']['type'] == "image/png") {
            $_SESSION['file_format_err'] = "Загрузите картинку формата PNG, JPG";
            header("Location: ../profile.php");
        }
    }
    $edit_req = $db->prepare("UPDATE users SET user_first=:first,user_last=:last WHERE user_id=:user_id");
    $edit_req->execute([
        "first" => $new_first,
        "last" => $new_last,
        "user_id" => $user_id
    ]);
    $_SESSION['edit_success'] = "Перезайдите в аккаунт чтобы изменения были видны!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
