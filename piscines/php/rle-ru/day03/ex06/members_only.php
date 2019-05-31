<?php
header("Content-Type: text/html");
if ($_SERVER["PHP_AUTH_USER"] === "zaz" && $_SERVER["PHP_AUTH_PW"] === "jaimelespetitsponeys")
{
?><html><body>
Bonjour Zaz<br />
<img src='data:image/png;base64,<?php
	echo base64_encode(file_get_contents("../img/42.png")), "'>\n";
?></body></html><?php
}
else
{
	header("WWW-Authenticate: Basic realm=''Espace membres''");
	?><html><body>Cette zone est accessible uniquement aux membres du site</body></html><?php
}
?>
