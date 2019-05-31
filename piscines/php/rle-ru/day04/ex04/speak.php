<?php
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else
{
	if ($_POST['msg'])
	{
		if (!file_exists("../private"))
			mkdir("../private");
		if (!file_exists("../private/chat"))
			file_put_contents("../private/chat", NULL);
		$file = unserialize(file_get_contents("../private/chat"));
		$fd = fopen("../private/chat", 'w');
		flock($fd, LOCK_EX | LOCK_SH);
		$new['login'] = $_SESSION['loggued_on_user'];
		$new['time'] = time();
		$new['msg'] = $_POST['msg'];
		$file[] = $new;
		file_put_contents("../private/chat", serialize($file));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	?>
	<html>
	<head>
	<script langage="javascript">
	top.frames['chat'].location = 'chat.php';
	window.setInterval(function(){top.frames['chat'].location = 'chat.php';}, 1000);</script>
	</head>
	<body>
	<form action="speak.php" method="POST">
	<input type="text" name="msg" value="" style="width:97%; height: 35px;" />
	<input type="submit" name="submit" value="Dire" />
	</form>
	</body>
	</html>
	<?php
}
?>
