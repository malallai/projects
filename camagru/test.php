<?php
ini_set("error_reporting", 1);
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

if (isset($_GET) && isset($_GET['dl'])) {
    $url = $_GET['dl'];
    header('Content-Description: File Transfer');
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename='.basename($url));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: public');
    header('Pragma: public');
    ob_clean();
    die();
}

if (isset($_POST['submit'])) {
    if ($_FILES["file"]["error"] > 0)
    {
        $error = $_FILES["file"]["error"];
    }
    else if (($_FILES["file"]["type"] == "image/gif") ||
        ($_FILES["file"]["type"] == "image/jpeg") ||
        ($_FILES["file"]["type"] == "image/png") ||
        ($_FILES["file"]["type"] == "image/pjpeg"))
    {
        if (!file_exists("uploads"))
            mkdir("uploads");
        $destination_url = 'uploads/demo.jpg';
        $source_img = $_FILES["file"]["tmp_name"];

        $final_file = compress($source_img, $destination_url, 50);

        $file_url = 'https://camagru.malallai.fr/uploads/demo.jpg';
        header('locations: /test.php?dl='.$file_url);
        die();

    } else {
        $error = "Uploaded image should be jpg or gif or png";
    }
}
?>
<html>
<head>
    <title>Php code compress the image</title>
</head>
<body>
<fieldset class="well">
    <legend>Upload Image:</legend>
    <form action="test.php" name="img_compress" id="img_compress" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label>Upload:</label>
                <input type="file" name="file" id="file"/>
            </li>
            <li>
                <input type="submit" name="submit" id="submit" class="submit btn-success"/>
            </li>
        </ul>
    </form>
</fieldset>
<center>
    <?php if($_POST){ if ($error) { ?>
        <h3><?php echo $error; ?></h3>
    <?php }} ?>
</center>
</body>
</html>