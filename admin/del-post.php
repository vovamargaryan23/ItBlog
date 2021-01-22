<?php
require_once "../db.php";
$getArtId = $_GET['delete_id'];
$img = $db->query("SELECT article_img FROM articles WHERE article_id='$getArtId'");
$delImg = $img->fetch(PDO::FETCH_ASSOC);
unlink("../media/" . $delImg['article_img']);
$db->query("DELETE FROM articles WHERE article_id='$getArtId'");
$db->query("DELETE FROM comments WHERE article_id='$getArtId'");
$_SESSION['del_success'] = "Статья успешно удалена!";
header("Location: " . $_SERVER['HTTP_REFERER']);
