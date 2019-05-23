<?php
    if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK") {
        if (!file_exists('../private')) {
            mkdir("../private");
        }
        if (!file_exists('../private/passwd')) {
            file_put_contents('../private/passwd', null);
        }
        $login = $_POST['login'];
        $passwd = hash('whirlpool', $_POST['passwd']);
        $users = unserialize(file_get_contents("../private/passwd"));
        $exist = 0;

        if ($users) {
            foreach ($users as $user) {
                if ($user['login'] === $login)
                    $exist = 1;
            }
        }

        echo $exist;

        if (!$exist) {
            $users[] = array("login" => $login, "passwd" => $passwd);
            file_put_contents("../private/passwd", serialize($users));
            print_r($users);
            echo "OK\n";
        } else {
            echo "ERROR\n";
        }
    } else {
        echo "ERROR\n";
    }