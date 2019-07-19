<link href="/Public/assets/css/profile.css" rel="stylesheet">
<div class="user-row">
    <a class="row user-infos-row">
        <div class="u-infos">
            <div class="main-infos">
                <div class="icons">
                    <i class="fas fa-user-alt"></i>
                </div>
                <div class="main-infos-sub">
                    <div class="inline-flex">
                        <span class="fullname"><?= $params['details']['user']['first_name']." ".$params['details']['user']['last_name'] ?></span>
                        <span class="username"><?= " ".$params['details']['user']['username']?></span>
                    </div>
                    <div class="usermail"><?= $params['details']['user']['email']?></div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="aside-middle-content">
    <div class="posts">
        <?php
        foreach ($params['details']['posts'] as $post) {
            $likes = $post['likes'];
            $comments = $post['comments'];
            $imagePath = $post['image_path'];
            ?>
            <div class="post">
                <span class="picture">
                    <img src="<?= $imagePath ?>">
                </span>
                <div class="details">
                    <div class="row">
                        <div class="content">
                            <span class="like-count">
                                <span><?= $likes ?></span>
                                <i class="far fa-heart"></i>
                            </span>
                            <span class="comments-count">
                                <span><?= $comments ?></span>
                                <i class="far fa-comment-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="aside-button button-logged">
    <div class="manage-pictures button-content">
        <a href="/user/edit"><span>Édition du profile</span></a>
    </div>
    <div class="logout button-content">
        <a href="/user/logout"><span>Déconnexion</span></a>
    </div>
</div>