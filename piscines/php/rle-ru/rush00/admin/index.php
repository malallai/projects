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
    ?>
    <form method="POST" action="add_product.php">
        <span>Add new product: </span>
        <input type="text" name="name">
        <span>Price: </span>
        <input type="text" name="price">
        <span>Year: </span>
        <input type="text" name="year">
        <input type="submit" name="submit" value="submit">
    </form>
    <form method="POST" action="del_product.php">
        <span>Delete a product: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="submit">
    </form>
    <form method="POST" action="delete.php">
        <span>Delete user: </span>
        <input type="text" name="name">
    </form>
    <?php
}
include('assets/templates/footer.php');
?>
