<?php
	include('assets/templates/header.php');

	if (isset($_SESSION['logged_as']) && ($_SESSION['logged_as'] !== ''|| $_SESSION['logged_as'] !== null))
		header("location: user.php");

	if (isset($_POST['log']))
	{
		if (auth($_POST['login'], $_POST['password'])) {
			$user = get_user($_POST['login']);
			$_SESSION['logged_as'] = $_POST['login'];
			$_SESSION['grade'] = $user['grade'];
			header("location: index.php");
		} else {
			?>
			<p>Une erreur est survenue, vérifier vos informations.</p>
			<?php
		}
	}
?>
<link rel="stylesheet" href="assets/css/login.css">
<div class="container">
    <div class="log-top-row">
        <div class="log-top-content">
            <div class="log-top">
                <a class="active login" href="login.php">Connexion</a>
                <a class="register"href="register.php">Inscription</a>
            </div>
        </div>
    </div>

    <div class="login-row">
		<div class="login-content">
			<p>Connexion</p>
			<div class="login">
				<form method="POST" action="login.php">
					<input type="text" name="login" id="login" class="form-control" placeholder="Login">
					<input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">
					<input class="btn btn-white" name="log" value="Connexion" type="submit">
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include ('assets/templates/footer.php');
?>
