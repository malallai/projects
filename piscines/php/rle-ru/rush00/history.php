<?php
session_start();
include("templates/header.php");
include("install.php");
install();
if ($_GET['order'])
{
	$items = unserialize(file_get_contents("../private/products"));
	$orders = unserialize(file_get_contents("../private/orders"));
	$o = $orders[$_GET['order']];
	if ($o){
		echo"<div class=\"flex-items\">";
	foreach ($o as $key => $value) {
		foreach ($items as $item) {
			if ($item['uid'] === $key) {
				?>
				<div class="item">
					<div class="image">
						<img src="https://cdn.intra.42.fr/users/<?= $item['name'] ?>.jpg">
					</div>
					<div class="description">
						<div class="name">
							<p><?= $item['name'] ?></p>
						</div>
						<div class="price">Prix : <?= $item['price'] ?>E (<?= ($value * $item['price']) ?>E)</div>
						<div class="quantity">Quantité : <?= $value ?></div>
					</div>
				</div>
				<?php
				break;
			}
		}}echo "</div>";
	}
}
$file = unserialize(file_get_contents("../private/accounts"));
if ($file != '')
{
	foreach ($file as $k=>$f)
		if ($f['name'] == $_SESSION['logged_as'])
			break;
	if ($f['orders'])
	{
		foreach($f['orders'] as $o)
		{
			?>
			<a href="history.php?order=<?=$o?>">Order number <?=$o?></a><br />
			<?php
		}
	}
}
include("templates/footer.php");
?>
