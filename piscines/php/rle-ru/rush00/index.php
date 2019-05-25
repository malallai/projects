<?php
include('templates/header.php');
?>
<div class="flex-items">
    <?php
    $file = unserialize(file_get_contents("../private/products"));
    if ($file)
    {
        foreach($file as $f)
        {
            ?>
            <div class="item">
                <div class="image">
                    <img src="https://cdn.intra.42.fr/users/<?= $f['name'] ?>.jpg">
                </div>
                <div class="description">
                    <div class="name">
                        <p><?= $f['name'] ?></p>
                    </div>
                    <div class="price">Prix : <?= $f['price'] ?>E</div>
                    <div class="quantity">Quantité : <?= $f['price'] ?></div>
                    <form action="additem.php" method="post">
                        <input class="id" name="id" type="text" value="<?= $f['uid'] ?>">
                        <input class="submit" name="submit" type="submit" value="Ajouter au panier">
                    </form>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
<?php
include('templates/footer.php');
?>