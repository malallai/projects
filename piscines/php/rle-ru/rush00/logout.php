<?php
session_start();
$_SESSION['logged_as'] = '';
header("location: index.php");
?>
