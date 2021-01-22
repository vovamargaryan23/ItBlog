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
    <div class="error-msg d-flex justify-content-center py-2">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['email_err'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['email_err'] . '</div>';
            unset($_SESSION['email_err']);
        }
        ?>
    </div>
    <div class="login-form d-flex justify-content-center align-items-end">
        <form method="POST" action="login-script.php">
            <div class="form-group px-5 py-2">
                <label for="exampleInputEmail1">Почта</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group px-5">
                <label for="exampleInputPassword1">Пароль</label>
                <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success" name="submit">Войти</button>
            </div>
        </form>
    </div>
    <div class="alert alert-light d-flex justify-content-center py-4" role="alert">
        Нет аккаунта? <a href="reg.php"> Регистрация</a>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>