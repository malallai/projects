<link href="/Public/assets/css/home.css" rel="stylesheet">
<div class="home-row">
    <div id="posts-row" class="row posts-row">
        <div class="posts">
            <?php
                foreach ($params['posts'] as $post) {
                    $details = $this->getPostDetails($post['id']);
                    $userName = $details['username'];
                    $likes = $details['likes'];
                    $imagePath = $details['image_path'];
            ?>
            <div class="post">
                <div class="author">
                    <div class="user">
                        <div class="user-pp">
                            <img src="/Public/assets/pictures/users/<?= $userName ?>.jpg">
                        </div>
                        <div class="user-infos">
                            <div class="user-name">
                                <a href="/user/id"><?= $userName ?> | <?= $post['id'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="picture">
                    <img src="<?= $imagePath ?>">
                </div>
                <div class="infos">
                    <div class="icons">
                        <a class="link" href="/comment/id"><i class="far fa-comment-alt"></i></a>
                        <a class="link"><i class="far fa-heart"></i></a>
                    </div>
                    <div class="like-counts">
                        <p><?= $likes ?><?= $likes > 1 ? " j'aimes" : " j'aime" ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="pagination">
            <div class="inputs">
                <?php $page = $params['page'] ?>
                <a class="input arrow <?= $page == 1 ? "disable" : "" ?>" href="/page/<?= $page - 1?>"><i class="fas fa-angle-left"></i></a>
                <?php
                    for ($i = $page; $i < $page + 3; $i++) {
                    ?>
                        <a class="input page <?= $i == $page ? "active" : "" ?>" href="/page/<?=$i?>"><?=$i?></a>
                    <?php
                    }
                ?>
                <a class="input arrow <?= $page == $params['pages'] ? "disable" : "" ?>" href="/page/<?= $page + 1?>"><i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>
    <div id="users-row" class="row users-row">
        <div class="content">
            <div class="row-title">
                <p>Utilisateurs</p>
            </div>
            <div class="users">
                <?php
                foreach ($params['users'] as $user) {
                    $details = $this->getUserDetails($user['id']);
                    $userName = $details['username'];
                    $posts = $details['posts'];
                ?>
                <div class="user">
                    <a href="/user" class="user-pp">
                        <img src="/Public/assets/pictures/users/<?= $userName ?>.jpg">
                    </a>
                    <div class="user-infos">
                        <div class="user-name">
                            <a href="/user/id"><?= $userName ?></a>
                        </div>
                        <div class="posts-count">
                            <p><?= $posts ?><?= $posts > 1 ? " photos" : " photo" ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>