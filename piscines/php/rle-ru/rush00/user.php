<?php
include('assets/templates/header.php');

if (!isset($_SESSION) || $_SESSION['logged_as'] == '')
{
    header('location: login.php');
}
if (isset($_POST['submit'])) {
    if ($_POST['submit'] === "Change password") {
        change_password($_SESSION['logged_as'], $_POST['oldpw'], $_POST['newpw']);
    } else if ($_POST['submit'] === "Del User") {print_r($_POST);
        if (auth($_SESSION['logged_as'], $_POST['pass'])) {
            $login = $_SESSION['logged_as'];
            logout();
            delete_user($login);
            header("location:index.php");
        }
    }
}
if ($_SESSION['logged_as'])
{
	echo "<a href='logout.php'>Log out</a><br />";
	?>
    <a><?= $_SESSION['logged_as'] ?></a>
	Change password:
	<form method="POST" action="user.php">
		Old password: <input type="password" name="oldpw" />
		New password: <input type="password" name="newpw" />
		<input type="submit" name="submit" value="Change password" />
	</form>
	Delete account:
	<form method="POST" action="user.php">
		Password: <input type="password" name="pass" />
		<input type="submit" name="submit" value="Del user" />
	</form>
	<?php
}
include('assets/templates/footer.php');
?>
