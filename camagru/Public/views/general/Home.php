<link href="/Public/assets/css/home.css" rel="stylesheet">
<script src='/Public/assets/js/posts.js'></script>
<div class="home-row">
    <div id="posts-row" class="row posts-row">
        <?=$this->pagination($params); ?>
        <div class="posts">
            <?php
            foreach ($params['posts'] as $post) {
                $d = $this->getController()->getPostController()->getPost($post['id']);
                $details = $d['post'];
                $userName = $details['username'];
                $likes = $details['likes'];
                $imagePath = $details['image_path'];
                $islike = $this->getController()->getPostController()->isLiked($post['id'], $this->getController()->getUserController()->getSessionId());?>
                <div class="post" id="post <?= \Core\Security::convertHtmlEntities($post['id']) ?>">
                    <div class="author">
                        <div class="user">
                            <div class="user-pp">
                                <img src="/Public/assets/pictures/users/<?=\Core\Security::convertHtmlEntities($details['avatar'])?>.jpg">
                            </div>
                            <div class="user-infos">
                                <div class="user-name">
                                    <a><?=\Core\Security::convertHtmlEntities($userName)?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-image">
                        <span class="picture">
                            <img src="<?=\Core\Security::convertHtmlEntities($imagePath) ?>">
                        </span>
                        <div class="comments">
                            <div class="row">
                                <?php
                                foreach ($d['comments'] as $comment) {
                                    $message = $comment['comment'];
                                    $author = $comment['username'];?>
                                    <div class="comment">
                                        <div class="content">
                                            <div class="comment-author">
                                                <a><?=\Core\Security::convertHtmlEntities($author)?></a>
                                            </div>
                                            <div class="comment-message">
                                                <?=\Core\Security::convertHtmlEntities($message)?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }?>
                            </div>
                            <div class="add-comment">
                                <div class="row">
                                    <form class="new-comment" id="<?=\Core\Security::convertHtmlEntities($post['id'])?>">
                                        <input id="input <?=\Core\Security::convertHtmlEntities($post['id'])?>" class="comment-content" placeholder="Ajouter un commentaire" onfocusin="focusCommentInput()" onfocusout="outFocusCommentInput()">
                                        <input hidden name="submit" type="submit" value="submit">
                                    </form>
                                    <a href="#" onclick="newComment()" class="submit">
                                        <div class="submit-content">
                                            <i id="<?=\Core\Security::convertHtmlEntities($post['id'])?>" class="fa fa-send"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="infos">
                        <div class="icons">
                            <a class="link" href="#" onclick="showComments()"><i id="<?= \Core\Security::convertHtmlEntities($post['id']) ?>" class="far fa-comment-alt"></i></a>
                            <a class="link like-button" href="#" onclick="like()"><i id="<?=\Core\Security::convertHtmlEntities($post['id'])?>" class="<?= $islike ? "fas fa-heart red" : "far fa-heart" ?>"></i></a>
                            <a class="link" href="#" onclick="copyLink()"><i id="<?=\Core\Security::convertHtmlEntities($post['id'])?>" class="fas fa-share"></i></a>
                        </div>
                        <div id="post-link-<?= \Core\Security::convertHtmlEntities($post['id'])?>" class="post-link hidden">
                            <input value="https://<?=$_SERVER['HTTP_HOST']?>/post/<?=$post['id']?>">
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
                    $details = $this->getController()->getUserController()->getUserHomeDetails($user['id']);
                    $userName = $details['username'];
                    $posts = $details['posts']; ?>
                    <div class="user">
                        <a class="user-pp">
                            <img src="/Public/assets/pictures/users/<?=\Core\Security::convertHtmlEntities($details['avatar'])?>.jpg">
                        </a>
                        <div class="user-infos">
                            <div class="user-name">
                                <a><?=\Core\Security::convertHtmlEntities($userName)?></a>
                            </div>
                            <div class="posts-count">
                                <p><?=\Core\Security::convertHtmlEntities($posts)?><?=$posts > 1 ? " photos" : " photo"?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>
