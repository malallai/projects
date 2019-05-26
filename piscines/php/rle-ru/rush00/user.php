<?php
include('assets/templates/header.php');



if (!isset($_SESSION) || $_SESSION['logged_as'] == '')
{
    header('location: login.php');
	?>
	<div>
	<form method="POST" action="login.php">
		Login: <input class="field" type="text" name="login" value="" />
		Password: <input class="field" type="password" name="pass" value="" />
		<input class="ok" type="submit" name="submit" value="Login!">
	</form>
	</div>
	Register new account :
	<div>
		<form method="POST" action="user.php">
			<span class="fields">Login: </span><input type="text" name="login" />
			<span class="fields">Password: </span><input type="password" name="pass" />
			<input type="submit" name="submit" value="Register">
		</form>
	</div>
	<?php
	if (file_exists("../private") && file_exists("../private/accounts") && $_POST['submit'] == 'Register')
	{
		$file = unserialize(file_get_contents("../private/accounts"));
		if ($file)
		{
			foreach($file as $f)
			{
				if ($f['login'] === $_POST['login'])
				{
					echo "User already exists\n";
					return ;
				}
			}
		}
		$new['login'] = $_POST['login'];
		$new['pass'] = hash('whirlpool', $_POST['pass']);
		$new['name'] = $_POST['name'];
		$new['grade'] = ($_POST['login'] == "rle-ru" || $_POST['login'] == "malallai") ? "admin" : "customer";
		$new['img'] = "https://cdn.intra.42.fr/users/".$new['login'].".jpg";
		$file[] = $new;
		file_put_contents("../private/accounts", serialize($file));
	}
}
if ($_POST['login'] === '' && $_POST['pass'] === '')
	echo "Incomplete fields\n";
if ($_SESSION['logged_as'])
{
	echo ">Log out</a><br />";
	?>
	Change password:
	<form method="POST" action="change.php">
		Old password: <input type="password" name="oldpw" />
		New password: <input type="password" name="newpw" />
		<input type="submit" name="submit" value="Change password" />
	</form>
	Delete account:
	<form method="POST" action="delete.php">
		Password: <input type="password" name="pass" />
		<input type="submit" name="submit" value="Delete account" />
	</form>
	<?php
}
include('assets/templates/footer.php');
?>
