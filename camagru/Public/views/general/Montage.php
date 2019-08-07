<link href="/Public/assets/css/montage.css" rel="stylesheet">
<script src='/Public/assets/js/montage.js'></script>
<div class="montage-row">
    <div id="main-row" class="row main-row">
        <div class="camera">
            <div class="video">
                <video id="video" width="1280" height="720" autoplay></video>
                <div class="montage-overlay video-overlay">
                    <div class="row">
                        <div class="content">
                            <div class="overlay-button force-send">
                                <a href="" onclick="forceSendPicture()"><i class="fas fa-cloud-upload-alt"></i></a>
                            </div>
                            <div class="overlay-button take-picture">
                                <a href="" onclick="takePicture()"><i id="0" class="far fa-circle"></i></a>
                            </div>
                            <div class="overlay-button reverse-cam">
                                <a href="" onclick="switchDevice()"><i id="0" class="fas fa-retweet"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="render">
                <canvas id="render" width="1280" height="720"></canvas>
                <div class="montage-overlay render-overlay">
                    <div class="row">
                        <div class="content">
                            <div class="overlay-button">
                                <div class="filter" id="gray">
                                    <img src="/Public/assets/pictures/filters/gray.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="pic">
                    <span class="picture">
                        <img src="/Public/assets/pictures/posts/test.jpg">
                    </span>
                    <div class="details">
                        <div class="row">
                            <div class="content">
                                <span class="delete-post">
                                    <a href="#" onclick="deletePost()"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pic">
                    <span class="picture">
                        <img src="/Public/assets/pictures/posts/0.jpg">
                    </span>
                    <div class="details">
                        <div class="row">
                            <div class="content">
                                <span class="delete-post">
                                    <a href="#" onclick="deletePost()"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pic">
                    <span class="picture">
                        <img src="/Public/assets/pictures/posts/1.jpg">
                    </span>
                    <div class="details">
                        <div class="row">
                            <div class="content">
                                <span class="delete-post">
                                    <a href="#" onclick="deletePost()"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pic">
                    <span class="picture">
                        <img src="/Public/assets/pictures/posts/2.jpg">
                    </span>
                    <div class="details">
                        <div class="row">
                            <div class="content">
                                <span class="delete-post">
                                    <a href="#" onclick="deletePost()"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
