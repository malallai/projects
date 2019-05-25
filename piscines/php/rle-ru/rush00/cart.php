<?php
include('templates/header.php');
?>
    <div class="flex-items">
        <?php
        $file = unserialize(file_get_contents("../private/products"));
        print_r($file);
        if ($file && isset($_SESSION['items'])) {
            foreach ($_SESSION['items'] as $key => $value) {
                echo $key." : ".$value." => ";
                foreach ($file as $item) {
                    if ($item['uid'] === $key) {
                        echo $item['name']." : ".$item['price']."\n";
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