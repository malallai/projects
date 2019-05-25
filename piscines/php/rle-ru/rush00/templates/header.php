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
            <img src="assets/images/42.svg">
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
                        <input type="submit" name="search" value="OK">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="white" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path>
                        </svg>
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
                            <a href="admin"><i class='fas fa-lock'></i></a>
                        </div>
                    </div>
                    <?php
                }
            ?>
            <div class="flex-icon">
                <div class="icon">
                    <a href="cart.php"><i class='fas fa-shopping-cart'></i> 0</a>
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