<?php
include 'auth.php';
session_start();
if (auth($_POST['login'], $_POST['passwd']))
{
	$_SESSION['loggued_on_user'] = $_POST['login'];
	?>
	<html>
	<body>
		<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		<iframe src="speak.php" width="100%" height="50px"></iframe>
	</body>
	</html>
	<?php
}
else
	echo "ERROR\n";
?>
