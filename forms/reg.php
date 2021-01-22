<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="error-msg text-center py-2">
        <?php
        if (isset($_SESSION['undef_err'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['undef_err'] . '</div>' . "<br/>";
            unset($_SESSION['undef_err']);
        } elseif (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>' . "<br/>";
            unset($_SESSION['error']);
        } elseif (isset($_SESSION['email_err'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['email_err'] . '</div>' . "<br/>";
            unset($_SESSION['email_err']);
        } elseif (isset($_SESSION['file_format_err'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['file_format_err'] . '</div>' . "<br/>";
            unset($_SESSION['file_format_err']);
        }
        ?>
    </div>
    <div class="login-form d-flex justify-content-center align-items-end">
        <form method="POST" action="reg-script.php" enctype="multipart/form-data">
            <div class="form-group px-5 py-2">
                <label for="exampleInputEmail1">Почта</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="my-3 mx-5">
                <label>Фотография</label> <br>
                <input type="file" name="user_img" class="user_img"><br>
            </div>
            <div class="form-group px-5 py-2">
                <label for="exampleInputEmail1">Имя</label>
                <input name="first" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group px-5 py-2">
                <label for="exampleInputEmail1">Фамилия</label>
                <input name="last" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group px-5">
                <label for="exampleInputPassword1">Пароль</label>
                <input name="pass1" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group px-5">
                <label for="exampleInputPassword2">Повторите пароль</label>
                <input name="pass2" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success " name="submit">Регистрация</button>
            </div>
        </form>
    </div>
    <div class="alert alert-light d-flex justify-content-center py-4" role="alert">
        Уже есть аккаунт? <a href="login.php"> Вход</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>