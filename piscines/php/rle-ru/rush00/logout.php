<?php
session_start();
$_SESSION['logged_as'] = '';
$_SESSION['grade'] = '';
header("location: index.php");
?>
