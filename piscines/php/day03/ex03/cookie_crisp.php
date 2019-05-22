<?php
    if (isset($_GET) && isset($_GET['action']) && isset($_GET['name'])) {
        $action = $_GET['action'];
        $name = $_GET['name'];
        if ($action == "set" && isset($_GET['value'])) {
            setcookie($name, $_GET['value'], time() + 3600);
        } else if ($action == "get") {
            echo ((isset($_COOKIE[$name]) && $_COOKIE[$name] != null) ? $_COOKIE[$name]."\n" : "");
        } else if ($action == "del") {
            setcookie($name, null, -1);
        }
    }