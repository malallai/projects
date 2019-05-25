<?php
session_start();
$_SESSION = null;
session_abort();
session_destroy();
header("location: index.php");
?>
