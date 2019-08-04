<link href="/Public/assets/css/montage.css" rel="stylesheet">
<script src='/Public/assets/js/montage.js'></script>
<div class="montage-row">
    <div id="main-row" class="row main-row">
        <div class="camera">
            <div class="video">
                <video id="video" width="1280" height="720" autoplay></video>
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
                            <span class="delete-post">
                                <span>&#160;</span>
                                <a href="#" onclick="deletePost()"><i id="<?= $post['id'] ?>" class="fas fa-trash"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="render" width="1280" height="720"></canvas>
        </div>
        <div class="filters">

        </div>
    </div>
    <div id="pics-row" class="row pics-row">
        <div class="content">
            <div class="row-title">
                <p>Photos précédentes</p>
            </div>
            <div class="pics">
            </div>
        </div>
    </div>
</div>
