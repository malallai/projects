<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="malallai">
    <link rel="icon" href="/Public/assets/ico/favicon.ico">
    <link href="/Public/assets/css/general.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <script src='/Public/assets/js/camagru.js'></script>
    <title>Camagru</title>
</head>
<body>
    <div class="container">
        <header>
            <div id="fix" class="fix"></div>
            <div id="top-header" class="top-header">
                <div id="flex-content" class="flex-content">
                    <div class="flex-component">
                        <div class="logo">
                            <a href="/">Camagru</a>
                        </div>
                    </div>
                    <div class="flex-component">
                        <div class="search-component">
                            <div class="search-bar">
                                <form class="bar">
                                    <input id="searchinput" name="search" placeholder="Search" type="text">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex-component">
                        <div class="icons">
                            <div class="flex-icon">
                                <div class="icon">
                                    <a href="/montage">
                                        <i class='fas fa-camera'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="flex-icon user-icon">
                                <div class="icon">
                                    <a href="/user">
                                        <i class='fas fa-user'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="user-nav">
            <p>User test</p>
        </div>
        <main id="inner" class="inner">
            <?= $content ?>
        </main>
        <footer>
            <div class="links align-left">
                <p>
                    <a class="link" href="https://instagram.com"><i class="fab fa-instagram"></i></a>
                    <a class="link" href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                    <a class="link" href="https://facebook.com"><i class="fab fa-facebook"></i></a>
                </p>
            </div>
            <div class="copyright text-align-right">
                <p>© malallai 2019.</p>
            </div>
        </footer>
    </div>
</body>
</html>