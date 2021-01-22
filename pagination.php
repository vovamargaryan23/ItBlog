<?php
spl_autoload_register(function ($class) {
    require("vendor/igorsimdyanov/pager/src/{$class}.php");
});
    $pdo = new PDO(
        'mysql:host=miniblog;dbname=miniblog',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $obj = new ISPager\PdoPager(
        new ISPager\PagesList(),
        $pdo,
        'articles',
        $order="ORDER BY article_id DESC"
    );

    $cat_id =  $obj->getItems()[0]['cat_id'];
foreach($obj->getItems() as $article){
?>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<article class="article">
    <div class="article-img">
        <img src="media/<?php echo $article['article_img'];?>" alt="" class="img-thumbnail rounded float-left">
    </div>
    <a href="single.php?article_id=<?php echo $article['article_id'];?>&category_id=<?php echo $article['cat_id'];?>" style="text-decoration: none; color: black;">

        <h1><?php echo $article['article_title'];?></h1>
    </a>
    <h5 class="text-secondary">| <?php echo $article['published_date'];?></h5>
        <?php
        foreach($db->query("SELECT * FROM categories WHERE cat_id='$cat_id'") as $category_id)
            {
                ?>
                <h5>Категория: <a href="/cat_filter.php?category_id=<?php echo $category_id['cat_id']?>"><?php echo $category_id['cat_name']; ?></a></h5>
                <?
            }
        ?>
        <p class="article_txt"><?php echo $article['article_text'];?></p>
    <div class="read-more-btn">
    <button type="button" class="btn btn-primary "><a href="single.php?article_id=<?php  echo $article['article_id'];?>&category_id=<?php echo $cat_id;?>" class="text-white">Читать дальше</a></button>
    </div>
</article>
<?php
}
echo "<div style='display:flex;justify-content:center;'><p>$obj</p></div>";
?>