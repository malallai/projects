<link href="/Public/assets/css/home.css" rel="stylesheet">
<script src='/Public/assets/js/posts.js'></script>
<div class="home-row full-row">
    <div id="posts-row" class="row posts-row full-post">
        <div class="posts">
            <?php
            $post = $params['post']['post'];
            $userName = $post['username'];
            $likes = $post['likes'];
            $imagePath = $post['image_path'];
            $user = $this->getController()->getUserController()->getUserHomeDetails($post['user_id']);
            $islike = $this->getController()->isLiked($post['id'], $this->getController()->getUserController()->getSessionId());

            use Core\Security; ?>
            <div class="post" id="post <?= $post['id'] ?>">
                <div class="author">
                    <div class="user">
                        <div class="user-pp">
                            <img src="/Public/assets/pictures/users/<?=$user['avatar']?>.jpg">
                        </div>
                        <div class="user-infos">
                            <div class="user-name">
                                <a><?=\Core\Security::convertChars($userName)?></a>
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
                            <?php
                            foreach ($params['post']['comments'] as $comment) {
                                $message = $comment['comment'];
                                $author = $comment['username'];?>
                                <div class="comment">
                                    <div class="content">
                                        <div class="comment-author">
                                            <a><?=\Core\Security::convertChars($author)?></a>
                                        </div>
                                        <div class="comment-message">
                                            <?=\Core\Security::convertChars($message)?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }?>
                        </div>
                        <div class="add-comment">
                            <div class="row">
                                <form class="new-comment" id="<?=$post['id']?>">
                                    <input id="input <?=$post['id']?>" class="comment-content" placeholder="Ajouter un commentaire" onfocusin="focusCommentInput()" onfocusout="outFocusCommentInput()">
                                    <input hidden name="submit" type="submit" value="submit">
                                </form>
                                <a onclick="newComment(this)" class="submit" id="<?=$post['id']?>">
                                    <div class="submit-content">
                                        <i class="fa fa-send"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="infos">
                    <div class="icons">
                        <a class="link" onclick="showComments(this)" id="<?= $post['id'] ?>"><i class="far fa-comment-alt"></i></a>
                        <a class="link like-button" onclick="like(this)" id="<?=$post['id']?>"><i class="<?= $islike ? "fas fa-heart red" : "far fa-heart" ?>"></i></a>
                        <a class="link" onclick="copyLink(this)" id="<?=$post['id']?>"><i class="fas fa-share"></i></a>
                    </div>
                    <div id="post-link-<?= $post['id']?>" class="post-link hidden">
                        <input value="<?=Security::getHost()?>/post/<?=$post['id']?>">
                    </div>
                    <div class="like-counts">
                        <p><?=$likes ?><?=$likes > 1 ? " j'aimes" : " j'aime" ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
