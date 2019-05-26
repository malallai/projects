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
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === "Add Product") {
            $new = array();
            $new['name'] = $_POST['name'];
            $new['price'] = $_POST['price'];
            $new['uid'] = rand(0, 100000);
            $new['year'] = $_POST['year'];
            create_product($new);
        } else if ($_POST['submit'] === "Dev Product") {
            delete_product(get_products($_POST['name']));
        } else if ($_POST['submit'] === "Del User") {
            delete_user($_POST['name']);
        }
        header("Location: admin.php");
    }

    ?>
    <form method="POST" action="add_product.php">
        <span>Add new product: </span>
        <input type="text" name="name">
        <span>Price: </span>
        <input type="text" name="price">
        <span>Year: </span>
        <input type="text" name="year">
        <input type="submit" name="submit" value="Add Product">
    </form>
    <form method="POST" action="del_product.php">
        <span>Delete a product: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Del Product">
    </form>
    <form method="POST" action="delete.php">
        <span>Delete user: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Del User">
    </form>
    <?php
}
include('assets/templates/footer.php');
?>
