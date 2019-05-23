<?php
    $users = unserialize(file_get_contents("../private/passwd"));
    if ($users) {
        if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK") {
            $login = $_POST['login'];
            $old_passwd = hash('whirlpool', $_POST['oldpw']);
            $passwd = hash('whirlpool', $_POST['newpw']);
            $exist = 0;

            foreach ($users as $key => $user) {
                if ($user['login'] === $login) {
                    if ($old_passwd === $user['passwd']) {
                        $users[$key]['passwd'] = $passwd;
                        file_put_contents("../private/passwd", serialize($users));
                        $exist = 1;
                    }
                }
            }
            if (!$exist)
                echo "ERROR\n";
            else
                echo "OK\n";
        } else {
            echo "ERROR\n";
        }
    } else {
        echo "ERROR\n";
    }
