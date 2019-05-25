<?php
    include 'auth.php';
    session_start();

    if (isset($_POST) && isset($_POST['login']) && isset($_POST['passwd'])) {
        if (auth($_POST['login'], $_POST['passwd'])) {
            $_SESSION['loggued_on_user'] = $_POST['login'];
        } else {
            $_SESSION['loggued_on_user'] = "";
            header("Location:./index.html");
        }
    } else {
        header("Location:./index.html");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>42 chat</title>
</head>
<body>
<h1>Hello World</h1>
</body>
</html>