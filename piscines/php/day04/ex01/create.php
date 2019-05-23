<?php
    if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK") {
        $login = $_POST['login'];
        $passwd = hash('whirlpool', $_POST['passwd']);
        $users = unserialize(file_get_contents("../private/passwd"));

        foreach ($users as $user) {
            if ($user['login'] === $login)
                die("ERROR\n");
        }

        $users[] = array("login"=>$login, "passwd"=>$passwd);
        file_put_contents("../private/passwd", serialize($users));
        die("OK\n");
    }
    die("ERROR\n");