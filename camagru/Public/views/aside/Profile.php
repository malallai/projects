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
                        <span class="fullname"><?= \Core\Security::convertChars($params['details']['first_name'])." ".\Core\Security::convertChars($params['details']['last_name']) ?></span>
                        <span class="username"><?= " ".\Core\Security::convertChars($params['details']['username'])?></span>
                    </div>
                    <div class="usermail"><?= \Core\Security::convertChars($params['details']['email'])?></div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="aside-middle-content">
    <div class="posts">
        <?php
        foreach ($params['posts'] as $post) {
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
                                <span><?= \Core\Security::convertChars($comments) ?></span>
                                <i class="far fa-comment-alt"></i>
                            </span>
                            <span class="delete-post">
                                <span>&#160;</span>
                                <a onclick="deletePost(this)" id="<?= $post['id'] ?>"><i class="fas fa-trash"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="c-button aside-profile-buttons">
    <div class="button-blue button-content">
        <a href="/user/edit"><span>Édition du profile</span></a>
    </div>
    <div class="button-red button-content">
        <a href="/user/logout"><span>Déconnexion</span></a>
    </div>
</div>
