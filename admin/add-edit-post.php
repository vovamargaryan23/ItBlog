<?php
session_start();
require_once("../db.php");
$articleTitle = $_POST['article_title'];
$catName = $_POST['article_cat'];
$articleTxt = $_POST['article_txt'];
$uniqueT = time();
$img = "$uniqueT" . $_FILES['article_img']['name'];
$img_tmp = $_FILES['article_img']['tmp_name'];
$update = false;
$publish_day = date("Y-m-d");
$id = 0;
$articleTitleEdit = "";
$articleCatEdit = "";
$articleTxtEdit = "";
$articleImgEdit = "";



if (isset($_POST['update'])) {
    $id = $_POST['article_id'];
    $articleImgEdit = "$uniqueT" . $_FILES['article_img']['name'];
    if ($_FILES['article_img']['type'] == "image/jpeg" || $_FILES['article_img']['type'] == "image/jpg" || $_FILES['article_img']['type'] == "image/png") {
        move_uploaded_file($img_tmp, "../media/$articleImgEdit");
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        $_SESSION['file_format_err'] = "Загрузите картинку формата PNG, JPG";
    }

    $articleTitleEdit = $_POST['article_title'];
    $articleCatName = $_POST['article_cat'];
    $articleCatId = $db->query("SELECT cat_id FROM categories WHERE cat_name='$articleCatName'");
    $articleCatEdit = $articleCatId->fetch(PDO::FETCH_ASSOC);
    $articleTxtEdit = $_POST['article_txt'];
    $artId = $_GET['edit_id'];
    $Old_img = $db->query("SELECT article_img FROM articles WHERE article_id='$artId'");
    $Img_for_del = $Old_img->fetch(PDO::FETCH_ASSOC);
    if ($_FILES['article_img']['name']) {
        unlink("../media/" . $Img_for_del['article_img']);
        $editRes = $db->prepare("UPDATE articles SET article_title=:articleEditTitle,cat_id=:cat_id,article_text=:articleEditTxt, article_img=:article_img WHERE article_id=:articleEditId");
        $editRes->execute(
            [
                "articleEditTitle" => $articleTitleEdit,
                "articleEditTxt" => $articleTxtEdit,
                "cat_id" => $articleCatEdit['cat_id'],
                "articleEditId" => $id,
                "article_img" => $articleImgEdit
            ]
        );
    } else {
        unset($_SESSION['file_format_err']);
        $editRes = $db->prepare("UPDATE articles SET article_title=:articleEditTitle,cat_id=:cat_id,article_text=:articleEditTxt WHERE article_id=:articleEditId");
        $editRes->execute(
            [
                "articleEditTitle" => $articleTitleEdit,
                "articleEditTxt" => $articleTxtEdit,
                "cat_id" => $articleCatEdit['cat_id'],
                "articleEditId" => $id,
            ]
        );
    }

    header('Location: admin_profile.php');
}

if ($_GET['edit_id']) {
    $update = true;
    $artId = $_GET['edit_id'];
    $result = $db->query("SELECT * FROM articles WHERE article_id=$artId");
    $arts = $result->fetch(PDO::FETCH_ASSOC);
    $articleTitleEdit = $arts['article_title'];
    $articleTxtEdit   = $arts['article_text'];
    if (isset($_POST['cancel'])) {
        header('Location: admin_profile.php');
    }
}


if (isset($_POST['add_submit'])) {
    if ($_FILES['article_img']['name']) {
        if ($_FILES['article_img']['type'] == "image/jpeg" || $_FILES['article_img']['type'] == "image/jpg" || $_FILES['article_img']['type'] == "image/png") {
            move_uploaded_file($img_tmp, "../media/$img");
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            $_SESSION['file_format_err'] = "Загрузите картинку формата PNG, JPG";
        }
        if (empty($articleTitle) || empty($articleTxt || empty($catName))) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            $_SESSION['form_err'] = "Не все поля заполнены!";
        } else {

            foreach ($db->query("SELECT cat_id FROM categories WHERE cat_name='$catName'") as $Cat) {
                $articleCat = $Cat['cat_id'];
                $addPost = $db->prepare("INSERT INTO articles(article_title, cat_id, article_text,published_date,article_img) VALUES(:article_title,:cat_id,:article_text,:published_date, :article_img)");
                $addPost->execute(
                    [
                        "article_title" => $articleTitle,
                        "cat_id" => $articleCat,
                        "article_text" => $articleTxt,
                        "published_date" => $publish_day,
                        "article_img" => $img
                    ]
                );
            }


            header('Location: ' . $_SERVER['HTTP_REFERER']);
            $_SESSION['form_success'] = "Статья Добавлена!";
        }
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        $_SESSION['file_format_err'] = "Загрузите картинку формата PNG, JPG";
    }
}
