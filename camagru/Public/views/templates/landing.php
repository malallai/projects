<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="malallai">
    <link href="/Public/assets/css/general.css" rel="stylesheet">
    <link href="/Public/assets/css/landing.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='/Public/assets/js/snackbar.js'></script>
    <title>Camagru</title>
</head>
<body>
    <div class="overlay"></div>
    <input hidden class="token" value="<?=\Core\Security::getToken()?>">
    <div class="container">
        <main id="main-content" class="main-content">
            <div id="left" class="left">
                <div class="demo">
                    <div class="landing-content">
                        <div class="web">
                            <div class="page">
                                <img src="/Public/assets/pictures/landing/web-home.jpg">
                            </div>
                            <div class="device">
                                <img src="/Public/assets/pictures/landing/web.png">
                            </div>
                        </div>
                        <div class="phone">
                            <div class="page">
                                <img src="/Public/assets/pictures/landing/phone-home.jpg">
                            </div>
                            <div class="device">
                                <img src="/Public/assets/pictures/landing/phone.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="right" class="right">
                <div class="right-overlay"></div>
                <div class="content">
                    <?= $content ?>
                </div>
            </div>
        </main>
    </div>
    <script>
        window.onload = () => {
            document.getElementById("left").style.minHeight = window.innerHeight + 'px';
            document.getElementById("right").style.minHeight = window.innerHeight + 'px';
        };
        window.onresize = () => {
            document.getElementById("left").style.minHeight = window.innerHeight + 'px';
            document.getElementById("right").style.minHeight = window.innerHeight + 'px';
        };
    </script>
</body>
</html>