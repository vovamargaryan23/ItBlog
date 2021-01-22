<?php
session_start();
require_once "db.php";
require_once "comments-script.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="css/single-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<h4 style="text-align: center;">Комментарии</h4>
<div class="comments">
    <?php
if($_SESSION['user'])
{
if($_SESSION['com_send_err'])
{
    echo'    <div class="alert alert-danger d-flex justify-content-center" role="alert">'.$_SESSION['com_send_err'].'</div>';
    unset($_SESSION['com_send_err']);
}
if($_SESSION['com_success'])
{
    echo'    <div class="alert alert-success d-flex justify-content-center" role="alert">'.$_SESSION['com_success'].'</div>';
    unset($_SESSION['com_success']);
}

    $article_id = $_GET['article_id'];
    foreach ($db->query("SELECT article_id FROM articles WHERE article_id='$article_id'")as $single_article)
    {
    ?>
    <form action="comments-script.php?article_id=<?php echo $single_article['article_id']; ?>" method="POST">
        <textarea name="com_txt" cols="100" rows="2" maxlength="100"></textarea>
        <button type="submit" name="send_com" class="btn btn-dark">Отправить</button>
    </form>
    <?
    }
}
else{
    ?>
    <div class="alert alert-warning d-flex justify-content-center" role="alert">
        Вы должны быть зарегистрированы чтобы писать здесь!
    </div>
    <?
}
foreach ($db->query("SELECT * FROM comments WHERE article_id=$article_id ORDER BY comm_id DESC") as $article_com)
{
?>
    <?php
    $user_id=$article_com['user_id'];
    foreach ($db->query("SELECT * FROM users WHERE user_id=$user_id") as $username){
        if($_SESSION['user']['user_id']==$user_id){
    ?>
    <div class="com-section d-flex justify-content-center align-items-center">
        <div class="user_img mr-4">
            <img src="../user_photos/<?php echo $username['user_img']; ?>" alt="Avatar" class="avatar" style="vertical-align: middle;width: 80px;height: 80px;">
        </div>
        <div class="coms my-3 w-50">
            <h3 class="d-inline-block"><?php echo $username['user_first']." ".$username['user_last']." (вы)";?></h3>
            <h5 class="d-inline-block ml-3 text-secondary my-3"><?php echo $article_com['date']; ?></h5>
            <p><?php echo $article_com['comment']; ?></p>
        </div>
    </div>
    <?
    }
    else{
        ?>
        <div class="com-section d-flex justify-content-center">
            <div class="user_img mr-4">
                <img src="../user_photos/<?php echo $username['user_img']; ?>" alt="Avatar" class="avatar" style="vertical-align: middle;width: 80px;height: 80px;">
            </div>
            <div class="coms my-3 w-50">
                <h3 class="d-inline-block"><?php echo $username['user_first']." ".$username['user_last']; ?></h3>
                <h5 class="d-inline-block ml-3 text-secondary my-3"><?php echo $article_com['date']; ?></h5>
                <p><?php echo $article_com['comment']; ?></p>
            </div>
        </div>
    <?
    }
    }
}
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</div>
</body>
</html>