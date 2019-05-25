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
    <title>42 chat</title>
</head>
<body>
<li>
    <iframe id="chat" name='chat' src='chat.php' width='100%' height='550'></iframe>
    <iframe name='speak' src='speak.php' width='100%' height='50' scrolling='no'></iframe>
</li>
<a href='logout.php'>Se déconnecter</a>
<a href='javascript:refresh();'>Rafraîchir</a>
<script langage="javascript">
    var frame = document.getElementById('chat');
    frame.onload = function() {
        frame.contentWindow.scrollTo(0, frame.contentWindow.document.getElementsByTagName('body')[0].scrollHeight);
    }

    function refresh () {
        frame.src = 'chat.php';
    }
</script>
</body>
</html>