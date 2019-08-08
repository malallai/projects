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
                        <span class="fullname"><?= \Core\Security::convertHtmlEntities($params['details']['first_name'])." ".\Core\Security::convertHtmlEntities($params['details']['last_name']) ?></span>
                        <span class="username"><?= " ".\Core\Security::convertHtmlEntities($params['details']['username'])?></span>
                    </div>
                    <div class="usermail"><?= \Core\Security::convertHtmlEntities($params['details']['email'])?></div>
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
                    <img src="<?= \Core\Security::convertHtmlEntities($imagePath) ?>">
                </span>
                <div class="details">
                    <div class="row">
                        <div class="content">
                            <span class="like-count">
                                <span><?= \Core\Security::convertHtmlEntities($likes) ?></span>
                                <i class="far fa-heart"></i>
                            </span>
                            <span class="comments-count">
                                <span><?= \Core\Security::convertHtmlEntities($comments) ?></span>
                                <i class="far fa-comment-alt"></i>
                            </span>
                            <span class="delete-post">
                                <span>&#160;</span>
                                <a href="#" onclick="deletePost()"><i id="<?= \Core\Security::convertHtmlEntities($post['id']) ?>" class="fas fa-trash"></i></a>
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