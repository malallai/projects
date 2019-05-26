<?php
function install()
{
if (!file_exists("../private"))
	mkdir("../private");
if (!file_exists("../private/accounts"))
	file_put_contents("../private/accounts", NULL);
if (!file_exists("../private/products"))
	file_put_contents("../private/products", NULL);
}
?>
