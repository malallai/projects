<link href="/Public/assets/css/home.css" rel="stylesheet">
<script src='/Public/assets/js/posts.js'></script>
<div class="home-row">
    <div id="posts-row" class="row posts-row">
        <div class="posts">
            <?php
            $post = $params['post']['post'];
            $userName = $post['username'];
            $likes = $post['likes'];
            $imagePath = $post['image_path'];
            $user = $this->getController()->getUserController()->getUserHomeDetails($post['user_ids']);
            $islike = $this->getController()->getPostController()->isLiked($post['id'], $this->getController()->getUserController()->getSessionId());?>
            <div class="post" id="post <?= \Core\Security::convertHtmlEntities($post['id']) ?>">
                <div class="author">
                    <div class="user">
                        <div class="user-pp">
                            <img src="/Public/assets/pictures/users/<?=\Core\Security::convertHtmlEntities($user['avatar'])?>.jpg">
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
                            foreach ($post['post']['comments'] as $comment) {
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
                    </div>
                    <div class="like-counts">
                        <p><?=$likes ?><?=$likes > 1 ? " j'aimes" : " j'aime" ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
