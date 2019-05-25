<?php
session_start();
include("header.php");
if ($_SESSION['grade'] != 'admin')
{
	?>
	<html>
	<head><link href="body.css" type="text/css" rel="stylesheet" /></head>
	<body>
	<div id="main">
	<?php
    $search = "You shall not pass";
    $url = "http://api.giphy.com/v1/gifs/search?q=".rawurlencode($search)."&api_key=ppHGDwDLRKMbmaBQFiWLTUneoMG1oa3F";
    $data = json_decode(file_get_contents($url), true);
    $id = rand(0, $data['pagination']['count']);
    $image = $data['data'][$id]['images']['original']['url'];
	?>
	<img src="<?php echo $image;?>" />
	</div>
	<body>
	</html>
	<?php
}
else
{
	?>
	<html>
	<head><link href="body.css" type="text/css" rel="stylesheet" /></head>
	<body>
	<div id="main">
		<form method="POST" action="add_product.php">
		<span class="fields">Add new product: </span>
		<input type="text" name="name">
		<span class="fields">Price: </span>
		<input type="text" name="price">
		<span class="fields">Year: </span>
		<input type="text" name="year">
		<input type="submit" name="submit" value="submit">
		</form>
	</div>
	<body>
	</html>
	<?php
}
?>
