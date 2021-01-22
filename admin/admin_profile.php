<?php
session_start();
require("../db.php");
$AdminCheck = $db->prepare("SELECT user_type FROM users WHERE user_id=:id");
$AdminCheck->execute([":id"=>$_SESSION['user']['user_id']]);
$result = $AdminCheck->fetch(PDO::FETCH_ASSOC);
if(!$_SESSION['user'])
{
    header("Location: /");
}

if($result['user_type']!='admin')
{
    $_SESSION['no_admin']="У вас нет доступа к админ панели!";
    header("Location: ../profile.php");
}
else{
    require_once "add-edit-post.php";
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Profile</title>
    </head>
    <body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../forms/name-edit.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" class="form-control" name="edit_first"  value="<?php echo $_SESSION['user']['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Изображение</label><br>
                            <input type="file" name="user_update_img">
                        </div>
                        <div class="form-group">
                            <label>Фамилия</label>
                            <input type="text" class="form-control" name="edit_last" value="<?php echo $_SESSION['user']['last_name']; ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="acc_change_sub">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="blog_header bg-light pb-4">
    <div class="header_info d-flex justify-content-around px-5 align-items-center">
        <div class="header_logo">
            <h1><a href="/">ITBLOG</a></h1>
        </div>
            <div class="login-reg">
                <a class="mx-2 h4"  href="../forms/logout.php">Выход</a>
            </div>
        </div>
        </div>
        <div class="user_info d-flex justify-content-center w-100 p-4 bg-light align-items-center">
            <div class="user_img mr-4">
                <img src="../user_photos/<?php echo $_SESSION['user']['user_img']; ?>" alt="Avatar" class="avatar" style="    vertical-align: middle;width: 100px;height: 100px;">
            </div>
            <div class="user_name"><h3><?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'];    ?></h3></div>
            <button type="button" class="btn btn-secondary ml-5" data-toggle="modal" data-target="#exampleModal">Edit &nbsp;<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg></button>
        </div>

    <?php
    if($_SESSION['edit_success'])
    {
        echo '<div class="alert alert-success" role="alert">'.$_SESSION['edit_success'].'</div>';
        unset($_SESSION['edit_success']);
    }
    if($_SESSION['form_err'])
    {
        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['form_err'].'</div>';
        unset($_SESSION['form_err']);
    }
    if($_SESSION['file_format_err'])
    {
        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['file_format_err'].'</div>';
        unset($_SESSION['file_format_err']);
    }
    if($_SESSION['form_success'])
    {
        echo '<div class="alert alert-success" role="alert">'.$_SESSION['form_success'].'</div>';
        unset($_SESSION['form_success']);
    }
    if($_SESSION['del_success'])
    {
        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['del_success'].'</div>';
        unset($_SESSION['del_success']);
    }
        ?>
        <form action="add-edit-post.php?edit_id=<?php echo $arts['article_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="add-post w-50 mx-auto text-center">
                <input type="hidden" name="article_id" value="<?php echo $arts['article_id']; ?>">
                <label for="Posttitle">Заголовок Статьи</label>
                <input type="text" class="form-control" name="article_title" value="<?php echo $articleTitleEdit; ?>">
                    <div class="my-3">
                        <label for="posttitle">Изображение Статьи</label> <br>
                        <input value="<?php echo $img;?>" type="file" name="article_img"><br>
                    </div>
                <label for="exampleFormControlSelect1">Выберите Категорию</label>
                <select class="form-control" id="exampleFormControlSelect1" name="article_cat">
                    <?php
                    foreach ($db->query("SELECT cat_name FROM categories") as $cat_name)
                    {
                        ?>
                        <option><?php echo $cat_name['cat_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="Posttext">Текст Статьи</label>
                <textarea name="article_txt" class="form-control" rows="3"><?php echo $articleTxtEdit; ?></textarea>
                <?php
                if($update==true)
                {
                    ?>
                    <button name="cancel" type="submit" class="btn btn-secondary btn-lg mt-3">Отмена</button>
                    <button name="update" type="submit" class="btn btn-warning btn-lg mt-3">Обновить</button>
                    <?
                }
                else
                    {
                        ?>
                        <button name="add_submit" type="submit" class="btn btn-success btn-lg mt-3">Добавить</button>
                        <?
                    }
                ?>
            </div>
        </form>


    <table class="table mt-5">
        <thead>
        <tr>
            <th scope="col">Article ID</th>
            <th scope="col">Article Title</th>
            <th scope="col">Article Category</th>
            <th scope="col">Article Text</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($db->query("SELECT * FROM articles ORDER BY article_id DESC") as $article_info)
        {
            $catId = $article_info['cat_id'];
        ?>
        <tr>
            <th scope="row"><?php echo $article_info['article_id']; ?></th>
            <td><?php echo $article_info['article_title']; ?></td>
            <?php
            foreach($db->query("SELECT cat_name FROM categories WHERE cat_id='$catId'") as $category)
            {
            ?>
            <td><?php echo $category['cat_name']; ?></td>
            <?php
            }
            ?>
            <td style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;width: 35vw;overflow:scroll;text-overflow: ellipsis;"><?php echo $article_info['article_text']; ?></td>
            <td>
                <a href="?edit_id=<?php echo $article_info['article_id'];?>">
                <button type="submit" class="btn btn-warning btn-lg" name="edit_button">Изменить</button>
                </a>
                &nbsp;
                <a href="del-post.php?delete_id=<?php echo $article_info['article_id']; ?>" style="text-decoration: none;">
                <button type="submit" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#delModal">Удалить</button>
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
    </html>
<?php
}
