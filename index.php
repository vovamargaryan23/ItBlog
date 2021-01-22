<?php
session_start();
require_once("db.php");
require_once "cat_filter.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ITBLOG</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require_once("includes/header.php");
    require("pagination.php");
    require("includes/footer.php");
    ?>
</body>

</html>