<?php
session_start();
include ('api/minishop.php');
if (is_installed() !== true) {
    header("location: install.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/icons.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>MiniShop</title>
</head>
<body>
<div class="container">
    <header class="header">
        <div class="flex-compononent">
            <div class="icon">
                <a href="index.php"><img src="assets/images/42.svg"></a>
            </div>
        </div>
        <div class="flex-compononent">
            <div class="searchbar">
                <div class="bar">
                    <input id="searchinput" name="search" placeholder="Search" type="text">
                </div>
                    <a class="search" href="" onclick="this.href='index.php?search='+document.getElementById('searchinput').value">
                        <div class="icon">
                            <i class='fas fa-search'></i>
                        </div>
                    </a>
            </div>
        </div>
        <div class="flex-compononent">
            <div class="icons">
                <?php
                    if (isset($_SESSION['logged_as']) && $_SESSION['grade'] === 'admin') {
                        ?>
                        <div class="flex-icon">
                            <div class="icon">
                                <a href="admin.php"><i class='fas fa-lock'></i></a>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <div class="flex-icon">
                    <div class="icon">
                        <a href="cart.php">
                            <i class='fas fa-shopping-cart'></i>
                            <div class="items-count">
                                <p><?= isset($_SESSION['items_count']) ? $_SESSION['items_count'] : 0 ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="flex-icon">
                    <div class="icon">
                        <a href="user.php"><i class='fas fa-user'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="inner">
