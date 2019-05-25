<?php
    session_start();

    if (isset($_POST['submit']) && isset($_POST['id'])) {
        $items = array();
        if (isset($_SESSION['items'])) {
            $items = $_SESSION['items'];
        }
        if (isset($items[$_POST['id']])) {
            $items[$_POST['id']] = $items[$_POST['id']] + 1;
        } else {
            $items[$_POST['id']] = 1;
        }
        $_SESSION['items'] = $items;
        $_SESSION['items_count'] =  isset($_SESSION['items_count']) ? $_SESSION['items_count'] + 1 : 1;
    }

   header("Location: index.php");