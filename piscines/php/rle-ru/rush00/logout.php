<?php
session_start();
$_SESSION = null;
session_unset();
header("location: index.php");
?>
