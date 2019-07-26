<link href="/Public/assets/css/home.css" rel="stylesheet">
<div class="home-row">
    <div id="posts-row" class="row posts-row">
        <?=$this->pagination($params); ?>
        <div class="posts">
            <?php
            foreach ($params['posts'] as $post) {
                $details = $this->getPostDetails($post['id']);
                $userName = $details['username'];
                $likes = $details['likes'];
                $imagePath = $details['image_path']; ?>
                <div class="post" id="post <?= $post['id'] ?>">
                    <div class="author">
                        <div class="user">
                            <div class="user-pp">
                                <img src="/Public/assets/pictures/users/<?=$userName?>.jpg">
                            </div>
                            <div class="user-infos">
                                <div class="user-name">
                                    <a><?=$userName?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-image">
                        <span class="picture">
                            <img src="<?=$imagePath ?>">
                        </span>
                        <div class="comments">
                            <div class="row">
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a>malallai</a>
                                        </div>
                                        <div class="comment-message">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a>malallai</a>
                                        </div>
                                        <div class="comment-message">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a>malallai</a>
                                        </div>
                                        <div class="comment-message">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a>malallai</a>
                                        </div>
                                        <div class="comment-message">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a>malallai</a>
                                        </div>
                                        <div class="comment-message">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a>malallai</a>
                                        </div>
                                        <div class="comment-message">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-comment">
                                <div class="row">
                                    <input class="comment-content" placeholder="test" onfocusin="focusCommentInput()" onfocusout="outFocusCommentInput()">
                                    <a class="submit"><i class="fa fa-send"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="infos">
                        <div class="icons">
                            <a class="link" href="#" onclick="showComments()"><i id="<?= $post['id'] ?>" class="far fa-comment-alt"></i></a>
                            <a class="link"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="like-counts">
                            <p><?=$likes ?><?=$likes > 1 ? " j'aimes" : " j'aime" ?></p>
                        </div>
                    </div>
                </div>
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
                        <a class="user-pp">
                            <img src="/Public/assets/pictures/users/<?=$userName?>.jpg">
                        </a>
                        <div class="user-infos">
                            <div class="user-name">
                                <a><?=$userName?></a>
                            </div>
                            <div class="posts-count">
                                <p><?=$posts?><?=$posts > 1 ? " photos" : " photo"?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>
