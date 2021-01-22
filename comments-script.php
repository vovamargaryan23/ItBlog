<?php
session_start();
require_once "db.php";
$date = date("Y-m-d");
$text = htmlspecialchars($_POST['com_txt']);
$article_id = $_GET['article_id'];
$user_id = $_SESSION['user']['user_id'];

if (isset($_POST['send_com'])) {
    if (empty($text)) {
        $_SESSION['com_send_err'] = "Комментарий не написан!";
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    } else {
        $comInsert = $db->prepare("INSERT INTO comments(article_id,user_id,comment,date) VALUES(:article_id,:user_id,:comment,:date)");
        $comInsert->execute(
            [
                "article_id" => $article_id,
                "user_id" => $user_id,
                "comment" => "$text",
                "date" => $date
            ]
        );
        $_SESSION['com_success'] = "Комментарий успешно добавлён!";
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
}
