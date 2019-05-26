<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/icons.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>ft_minishop</title>
</head>
<body>
<div class="header">
    <div class="flex-compononent">
        <div class="icon">
            <a href="index.php"><img src="assets/images/42.svg"></a>
        </div>
    </div>
    <div class="flex-compononent">
        <form action="search.php" method="post" class="searchbar">
            <div class="bar">
                <input name="search" placeholder="Search" type="text">
            </div>
            <div  class="search">
                <label>
                    <div class="icon">
                        <input type="submit" name="submit" value="OK">
                        <i class='fas fa-search'></i>
                    </div>
                </label>
            </div>
        </form>
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
                    <a href="cart.php"><i class='fas fa-shopping-cart'></i> <?= isset($_SESSION['items_count']) ? $_SESSION['items_count'] : 0 ?></a>
                </div>
            </div>
            <div class="flex-icon">
                <div class="icon">
                    <a href="user.php"><i class='fas fa-user'></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
