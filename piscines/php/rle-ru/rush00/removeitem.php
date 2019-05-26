<?php
    session_start();

    if (isset($_POST['submit']) && isset($_POST['id'])) {
        $items = array();
        if (isset($_SESSION['items'])) {
            $items = $_SESSION['items'];
        }
        if (isset($items[$_POST['id']]) && $items[$_POST['id']] > 1) {
            $items[$_POST['id']] = $items[$_POST['id']] - 1;
        } else {
            unset($items[$_POST['id']]);
        }
        $_SESSION['items'] = $items;
        $_SESSION['items_count'] -= 1;
    }

   header("Location: cart.php");
?>
