<?php
include('assets/templates/header.php');
if ($_SESSION['grade'] != 'admin')
{
    ?>
    <div class="shall-not-pass">
        <?php
        $search = "You shall not pass";
        $url = "http://api.giphy.com/v1/gifs/search?q=".rawurlencode($search)."&api_key=ppHGDwDLRKMbmaBQFiWLTUneoMG1oa3F";
        $data = json_decode(file_get_contents($url), true);
        $id = rand(0, $data['pagination']['count']);
        $image = $data['data'][$id]['images']['original']['url'];
        ?>
        <img src="<?= $image ?>" />
    </div>
    <?php
}
else
{
    $items = get_products();
    $orders = get_orders();
    if ($_GET['order'])
    {
        $o = $orders[$_GET['order']];
        if ($o)
        {
            echo"<div class=\"flex-items\">";
            foreach ($o as $key => $value)
            {
                foreach ($items as $item)
                {
                    if ($item['uid'] === $key)
                    {
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
                }
            }
            echo "</div>";
        }
    }
    if ($orders)
    {
        foreach($orders as $k=>$o)
        {
            ?>
            <a href="admin_orders.php?order=<?=$k?>">Order number <?=$k?></a><br />
            <?php
        }
    }
}
include('assets/templates/footer.php');
?>
