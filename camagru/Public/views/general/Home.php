<link href="/Public/assets/css/home.css" rel="stylesheet">
<div class="home-row">
    <div id="posts-row" class="row posts-row">
        <?=$this->pagination($params); ?>
        <div class="posts">
            <?php
            if ($pages > 0) {
                foreach ($params['posts'] as $post) {
                    $details = $this->getPostDetails($post['id']);
                    $userName = $details['username'];
                    $likes = $details['likes'];
                    $imagePath = $details['image_path']; ?>
                    <div class="post">
                        <div class="author">
                            <div class="user">
                                <div class="user-pp">
                                    <img src="/Public/assets/pictures/users/<?= $userName
                                    ?>.jpg">
                                </div>
                                <div class="user-infos">
                                    <div class="user-name">
                                        <a href="/user/id"><?= $userName
                                            ?> | <?= $post['id'] ?></a>
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
                    <?php
                }
            } else {
                ?>
                <h1>Il n'y a aucun poste pour le moment.</h1>
                <?php
            } ?>
        </div>
        <?=$this->pagination($params); ?>
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
                    $posts = $details['posts']; ?>
                    <div class="user">
                        <a href="/user" class="user-pp">
                            <img src="/Public/assets/pictures/users/<?=$userName
                            ?>.jpg">
                        </a>
                        <div class="user-infos">
                            <div class="user-name">
                                <a href="/user/id"><?=$userName
                                    ?></a>
                            </div>
                            <div class="posts-count">
                                <p><?=$posts
                                    ?><?=$posts > 1 ? " photos" : " photo" ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>
