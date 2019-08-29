<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="malallai">
    <link rel="icon" href="/Public/assets/ico/favicon.ico">
    <link href="/Public/assets/css/general.css" rel="stylesheet">
    <link href="/Public/assets/css/landing.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Camagru</title>
</head>
<body>
    <input hidden class="token" value="<?=\Core\Security::convertHtmlEntities($token)?>">
    <div class="background">
        <div class="overlay"></div>
        <div class="background-image"></div>
        <div class="left-overlay"></div>
    </div>
    <div class="container">
        <main id="main-content" class="main-content">
            <div class="right">
                <div class="title">CAMAGRU</div>
                <div class="demo">
                    <div class="web">
                        <img src="/Public/assets/pictures/landing/web.png">
                    </div>
                    <div class="phone">
                        <img src="/Public/assets/pictures/landing/phone.png">
                    </div>
                </div>
            </div>
            <div class="left"></div>
        </main>
    </div>
</body>
</html>