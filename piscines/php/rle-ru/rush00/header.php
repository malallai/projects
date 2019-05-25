<?php
session_start();
?>

<html>
<head>
<link href="header.css" type="text/css" rel="stylesheet" />
<meta charset="utf-8" />
</head>
<body>
<header>
	<span><a href="index.php">Home</a></span>
	<span>
		<div class="dropdown">Bla bla bla
		</div>
		<a href="index.php">Section 1</a>
	</span>
	<span>
		<div class="dropdown">Blu blu blu
		</div>
		<a href="index.php">Section 2</a>
	</span>
	<span>
		<div class="dropdown">Ble ble ble
		</div>
		<a href="index.php">Section 3</a>
	</span>
	<span><a href="logout.php">Logout</a></span>
	<div id="user">
		<?php
			if ($_SESSION['logged_as'] != '')
			{
				if ($_SESSION['grade'] == 'admin')
				{
					?>
					<html>
						<img style="width:50px;height:70px;" src="<?php echo "https://cdn.intra.42.fr/users/" . $_SESSION['logged_as'] . ".jpg"?>" />
						<a href="admin.php"><span id="hello">Hello grandmaster <?php echo $_SESSION['logged_as'];?></span></a>
					</html><?php
				}
				else
				{
					?>
					<html>
						<span id="hello"><?php echo $_SESSION['logged_as'];?></span>
					</html><?php
				}
			}
			else
			{
				?>
					<form method="POST" action="login.php">
						<input class="field" type="text" name="login" value="" />
						<input class="field" type="password" name="pass" value="" />
						<input class="ok" type="submit" name="submit" value="Login!">
					</form>
					<a id="create" href="create.php">Create account</a>
				<?php
			}
		?>
	</div>
</header>
</body>
</html>
