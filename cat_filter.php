<?php
session_start();
require_once "db.php";
$category_id = $_GET['category_id'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ITBLOG</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
require_once ("includes/header.php");
foreach ($db->query("SELECT * FROM articles WHERE cat_id='$category_id'") as $filtered_article)
{
    $cat_id = $filtered_article['cat_id'];
?>
<article class="article">
    <div class="article-img">
        <img src="media/<?php echo $filtered_article['article_img']?>" alt="" class="img-thumbnail rounded float-left">
    </div>
    <a href="single.php?article_id=<?php echo $filtered_article['article_id']?>&category_id=<?php echo $cat_id;?>" style="text-decoration: none; color: black;">

        <h1><?php echo $filtered_article['article_title']?></h1>
    </a>
    <h5 class="text-secondary">| <?php echo $filtered_article['published_date'];?></h5>
        <?php
        foreach($db->query("SELECT * FROM categories WHERE cat_id='$cat_id'") as $category_id)
            {
                ?>
                <h5>Категория: <a href="/cat_filter.php?category_id=<?php echo $category_id['cat_id']?>"><?php echo $category_id['cat_name']; ?></a></h5>
    <?
    }
    ?>
        <p class="article_txt"><?php echo $filtered_article['article_text']?></p>
    <div class="read-more-btn">
        <button type="button" class="btn btn-primary "><a href="single.php?article_id=<?php echo $filtered_article['article_id']?>&category_id=<?php echo $cat_id;?>" class="text-white">Читать дальше</a></button>
    </div>
</article>
    <?
}
require "includes/footer.php";
?>
</body>
</html>
