<?php
include('templates/header.php');
?>
<div class="flex-items">
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/malallai.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>nom</p>
            </div>
            <div class="price">Prix : x</div>
            <div class="quantity">Quantité : x</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="1">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/malallai.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>nom</p>
            </div>
            <div class="price">Prix : x</div>
            <div class="quantity">Quantité : x</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="1">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/malallai.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>nom</p>
            </div>
            <div class="price">Prix : x</div>
            <div class="quantity">Quantité : x</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="1">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
</div>
<?php
include('templates/footer.php');
?>