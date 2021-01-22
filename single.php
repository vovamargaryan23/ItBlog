<?php
session_start();
require_once "db.php";
if(empty($_GET))
{
    header("Location: /");
}
$article_id = $_GET['article_id'];
$cat_id = $_GET['category_id'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    foreach ($db->query("SELECT * FROM articles WHERE article_id='$article_id'") as $single_article) {
        ?>
        <title><?php echo $single_article['article_title'] ?></title>
        <?
    }
    ?>
    <link rel="stylesheet" href="css/single-style.css">
</head>
<body>
<?php

require_once "includes/header.php";
?>
<article class="single-article">
    <?php

    foreach ($db->query("SELECT * FROM articles WHERE article_id='$article_id'")as $single_article)
    {

    ?>
        <h1><?php echo $single_article['article_title'] ?></h1>
    <h3 class="text-secondary">| <?php echo $single_article['published_date'];?></h3>
    <?php
    foreach ($db->query("SELECT * FROM categories WHERE cat_id='$cat_id'") as $category) {
        ?>
        <h5>Категория: <a
                    href="/cat_filter.php?category_id=<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name']; ?></a>
        </h5>
        <?
    }
    ?>
    <p><?php echo $single_article['article_text']; ?></p>
</article>
<?php

}
require_once "includes/comments.php";
?>
</body>
</html>
