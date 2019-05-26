<?php
include('assets/templates/header.php');

    if (isset($_POST['confirm'])) {
        confirm_order($_SESSION['logged_as']);
    }

?>
    <div class="flex-items">
        <?php
		$total_price = 0;
        $products = get_products();
        if ($products && isset($_SESSION['items'])) {
            foreach ($_SESSION['items'] as $key => $value) {
                foreach ($products as $item) {
                    if ($item['uid'] === $key) {
						$total_price += $item['price'] * $value;
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
                                <form action="removeitem.php" method="post">
                                    <input class="id" name="id" type="text" value="<?= $item['uid'] ?>">
                                    <input class="submit" name="submit" type="submit" value="Supprimer">
                                </form>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                }
            }
        }
        ?>
    </div>
    <?php
    if (isset($_SESSION['items'])) {
        echo "Total price: $total_price";?>
        <form method="POST" action="<?php echo $_SESSION['logged_as'] ? "cart.php" : "user.php";?>">
            <input type="submit" name="confirm" value="Valider la commande" />
        <a href="history.php">Order history </a>
        </form>
    <?php
    }
include('assets/templates/footer.php');
?>