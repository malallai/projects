<?php
include('assets/templates/header.php');

if (!isset($_SESSION) || $_SESSION['logged_as'] == '')
{
    header('location: login.php');
}
if (isset($_POST['submit'])) {
    if ($_POST['submit'] === "Change password") {
        change_password($_SESSION['logged_as'], $_POST['oldpw'], $_POST['newpw']);
    } else if ($_POST['submit'] === "Del User") {
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
	?>
    Connecté en tant que : <a><?= $_SESSION['logged_as'] ?></a>
    </br>
	Change password:
	<form method="POST" action="user.php">
		Old password: <input type="password" name="oldpw" />
		New password: <input type="password" name="newpw" />
		<input type="submit" name="submit" value="Change password" />
	</form>
	Delete account:
	<form method="POST" action="user.php">
		Password: <input type="password" name="pass" />
		<input type="submit" name="submit" value="Del User" />
	</form>
    </br>
    <a href='logout.php'>Log out</a>
	<?php
}
include('assets/templates/footer.php');
?>
