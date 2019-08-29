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
    $file = $_GET['dl'];
    header('Pragma: public'); 	// required
    header('Expires: 0');		// no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file)).' GMT');
    header('Cache-Control: private',false);
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '.filesize($file));	// provide file size
    header('Connection: close');
    readfile($file);
    die();
}

if (isset($_POST['submit'])) {
    if ($_FILES["file"]["error"] > 0)
    {
        $error = "Error > 0 ".$_FILES["file"]["error"];
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

        $file_url = 'uploads/demo.jpg';
        header('Location: /test.php?dl='.$file_url);
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