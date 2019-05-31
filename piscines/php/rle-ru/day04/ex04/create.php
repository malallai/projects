<?php
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'])
{
	if (!file_exists('../private'))
		mkdir('../private');
	if (!file_exists('../private/passwd'))
		file_put_contents('../private/passwd', NULL);
	$file = unserialize(file_get_contents('../private/passwd'));
	if ($file)
	{
		$already_exist = FALSE;
		foreach($file as $a)
			if ($a['login'] == $_POST['login'])
				$already_exist = TRUE;
	}
	if ($already_exist == TRUE)
		echo "ERROR\n";
	else
	{
		$new['login'] = $_POST['login'];
		$new['passwd'] = hash('whirlpool', $_POST['passwd']);
		$file[] = $new;
		file_put_contents('../private/passwd', serialize($file));
		header('Location: index.html');
		echo "OK\n";
	}
}
else
	echo "ERROR\n";
?>
