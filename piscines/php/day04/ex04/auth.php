<?php
    function auth($login, $passwd) {
        if (!$login || !$passwd)
            return false;
        $hashed_passwd = hash('whirlpool', $passwd);
        $users = unserialize(file_get_contents("../private/passwd"));
        if ($users) {
            foreach ($users as $key => $user) {
                if ($user['login'] === $login) {
                    if ($user['passwd'] === $hashed_passwd) return true;
                    else return false;
                }
            }
        }
        return false;
    }