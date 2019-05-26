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
            $new['categories']['year'] = $_POST['year'];
            $new['categories']['campus'] = $_POST['campus'];
            create_product($new);
        } else if ($_POST['submit'] === "Del Product") {
            delete_product(get_product($_POST['name']));
        } else if ($_POST['submit'] === "Del User") {
            delete_user($_POST['name']);
        } else if ($_POST['submit'] === "Add Category") {
            create_category($_POST['name']);
        } else if ($_POST['submit'] === "Del Category") {
            delete_category($_POST['name']);
        } else if ($_POST['submit'] === "Add Item") {
            add_item_category($_POST['name'], $_POST['item']);
        } else if ($_POST['submit'] === "Del Item") {
            delete_item_category($_POST['name'], $_POST['item']);
        } else if ($_POST['submit'] === "Add Cat Product") {
            add_cat_to_product($_POST['name'], $_POST['category'], $_POST['item']);
        } else if ($_POST['submit'] === "Del Cat Product") {
            remove_cat_from_product($_POST['name'], $_POST['category']);
        }
        //header("Location: admin.php");
    }

    ?>
    <form method="POST" action="admin.php">
        <span>Add new product: </span>
        <input type="text" name="name">
        <span>Price: </span>
        <input type="text" name="price">
        <span>Year: </span>
        <input type="text" name="year">
        <span>campus: </span>
        <input type="text" name="campus">
        <input type="submit" name="submit" value="Add Product">
    </form>
    <form method="POST" action="admin.php">
        <span>Add new Category: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Add Category">
    </form>
    <form method="POST" action="admin.php">
        <span>Delete Category: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Del Category">
    </form>
    <form method="POST" action="admin.php">
        <span>Add item to Category: </span>
        <input type="text" name="name">
        <span>Item: </span>
        <input type="text" name="item">
        <input type="submit" name="submit" value="Add Item">
    </form>
    <form method="POST" action="admin.php">
        <span>Del item from Category: </span>
        <input type="text" name="name">
        <span>Item: </span>
        <input type="text" name="item">
        <input type="submit" name="submit" value="Del Item">
    </form>
    <form method="POST" action="admin.php">
        <span>Delete a product: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Del Product">
    </form>
    <form method="POST" action="admin.php">
        <span>Add category to product: </span>
        <input type="text" name="name">
        <input type="text" name="category">
        <input type="text" name="item">
        <input type="submit" name="submit" value="Add Cat Product">
    </form>
    <form method="POST" action="admin.php">
        <span>Del category for product: </span>
        <input type="text" name="name">
        <input type="text" name="category">
        <input type="submit" name="submit" value="Del Cat Product">
    </form>
    <form method="POST" action="admin.php">
        <span>Delete user: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Del User">
    </form>
    <?php
}
include('assets/templates/footer.php');
?>
