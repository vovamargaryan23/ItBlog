<?php
session_start();
require("./db.php");
?>
<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title></title>
    </head>
    <body>
    <div class="blog_header bg-light pb-4">
        <div class="header_info d-flex justify-content-around px-5 align-items-center">
        <div class="header_logo">
            <h1><a href="/">ITBLOG</a></h1>
        </div>
        <?php
        if($_SESSION['user'])
        {
            ?>
            <div class="login-reg">
                <a class="mx-2 h4" href="../profile.php">Профиль</a>
                <a class="mx-2 h4"  href="forms/logout.php">Выход</a>
            </div>
            <?
        }
        else{
            ?>
            <div class="login-reg">
                <a class="mx-2 h4" href="forms/login.php">Вход</a>
                <a class="mx-2 h4"  href="forms/reg.php">Регистрация</a>
            </div>
            <?
        }
        ?>
        </div>
    <div class="header_cats p-2 px-5 text-center">
        <?php
     $conn = $db->query("SELECT * FROM categories");
    while ( $cats = $conn->fetch(PDO::FETCH_ASSOC))
    {
        ?>
        <a class="link px-3 h3" id="<?php $cats['cat_id']?>" href="/cat_filter.php?category_id=<?php echo $cats['cat_id']?>"><?echo $cats['cat_name']?></a>
        <?
    }

        ?>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
    </html>