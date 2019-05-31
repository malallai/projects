<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && file_exists('../private') && file_exists('../private/passwd'))
{
	$file = unserialize(file_get_contents('../private/passwd'));
	if ($file)
	{
		foreach ($file as $k => $a)
		{
			if ($a['login'] == $_POST['login'])
			{
				if ($a['passwd'] == hash('whirlpool', $_POST['oldpw']))
				{
					$a['passwd'] = hash('whirlpool', $_POST['newpw']);
					$file[$k] = $a;
					break ;
				}
				else
				{
					echo "ERROR\n";
					return ;
				}
			}
		}
		file_put_contents('../private/passwd', serialize($file));
		header('Location: index.html');
		echo "OK\n";
	}
}
else
	echo "ERROR\n";
?>
