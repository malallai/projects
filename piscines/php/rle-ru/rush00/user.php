<?php
include('assets/templates/header.php');

if (!isset($_SESSION) || $_SESSION['logged_as'] == '')
{
    header('location: login.php');
}
if ($_SESSION['logged_as'])
{
	echo "<a href='logout.php'>Log out</a><br />";
	?>
    <a><?= $_SESSION['logged_as'] ?></a>
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
