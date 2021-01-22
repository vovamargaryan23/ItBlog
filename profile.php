<?php
session_start();
require_once "db.php";
if ($_SESSION['user']) {
    $AdminCheck = $db->prepare("SELECT user_type FROM users WHERE user_id=:id");
    $AdminCheck->execute([":id" => $_SESSION['user']['user_id']]);
    $result = $AdminCheck->fetch(PDO::FETCH_ASSOC);
    if ($result['user_type'] == "admin") {
        header("Location: admin/admin_profile.php");
    } else {
        if ($_SESSION['no_admin']) {
            echo $_SESSION['no_admin'];
            unset($_SESSION['no_admin']);
        }
    }
} else {
    header("Location: /");
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
                            <input type="text" class="form-control" name="edit_first" value="<?php echo $_SESSION['user']['first_name']; ?>">
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
                <a class="mx-2 h4" href="forms/logout.php">Выход</a>
            </div>
        </div>
    </div>
    <div class="user_info d-flex justify-content-center align-items-center w-100 p-4 bg-light">
        <div class="user_img mr-4">
            <img src="user_photos/<?php echo $_SESSION['user']['user_img']; ?>" alt="Avatar" class="avatar" style="    vertical-align: middle;width: 100px;height: 100px;">
        </div>
        <div class="user_name">
            <h3><?php echo $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'];    ?></h3>
        </div>
        <button type="button" class="btn btn-secondary ml-5" data-toggle="modal" data-target="#exampleModal">Edit &nbsp;<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg></button>
    </div>
    <?php
    if ($_SESSION['edit_success']) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['edit_success'] . '</div>';
        unset($_SESSION['edit_success']);
    } elseif ($_SESSION['file_format_err']) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['file_format_err'] . '</div>';
        unset($_SESSION['file_format_err']);
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>