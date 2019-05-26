<?php
session_start();

else
{
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === "Add Product") {
            $new = array();
            $new['name'] = $_POST['name'];
            $new['price'] = $_POST['price'];
            $new['uid'] = rand(0, 100000);
            $new['year'] = $_POST['year'];
            create_product($new);
        } else if ($_POST['submit'] === "Del Product") {
            delete_product(get_product($_POST['name']));
        } else if ($_POST['submit'] === "Del User") {
            delete_user($_POST['name']);
        }
        header("Location: admin.php");
    }
}

foreach ($file as $k=>$f)
{
	if ($f['login'] == $_SESSION['logged_as'])
	{
		if (hash('whirlpool', $_POST['oldpw']) == $f['pass'])
		{
			$f['pass'] = hash('whirlpool', $_POST['newpw']);
			$file[$k] = $f;
			file_put_contents("private/accounts", $file);
			break ;
		}
		else
			header("location: user.php?msg=wrongpw");
	}
}
header("location: user.php?msg=passchangesuccess");
