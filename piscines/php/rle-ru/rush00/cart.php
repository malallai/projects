<?php
include('templates/header.php');
?>
    <div class="flex-items">
        <?php
        $file = unserialize(file_get_contents("../private/products"));
        if ($file && isset($_SESSION['items'])) {
            foreach ($_SESSION['items'] as $key => $value) {
                foreach ($file as $item) {
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
include('templates/footer.php');
?>