<?php
function auth($login, $passwd)
{
	if (file_exists('../private') && file_exists('../private/passwd'))
	{
		$file = unserialize(file_get_contents('../private/passwd'));
		foreach ($file as $a)
			if ($a['login'] == $login)
				if (hash('whirlpool', $passwd) == $a['passwd'])
					return (TRUE);
	}
	return (FALSE);
}
?>
