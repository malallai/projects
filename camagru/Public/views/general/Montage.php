<link href="/Public/assets/css/montage.css" rel="stylesheet">
<script src='/Public/assets/js/montage.js'></script>
<div class="montage-row">
    <div id="main-row" class="row main-row">
        <div class="camera">
            <div class="video">
                <video id="video" width="1280" height="720" autoplay></video>
                <div class="video-overlay">
                    <div class="row">
                        <div class="content">
                            <div class="overlay-button force-send">
                                <a href="" onclick="test()"><i class="fas fa-cloud-upload-alt"></i></a>
                            </div>
                            <div class="overlay-button take-picture">
                                <a href="" onclick="test()"><i id="0" class="far fa-circle"></i></a>
                            </div>
                            <div class="overlay-button reverse-cam">
                                <a href="" onclick="test()"><i id="0" class="far fa-circle"></i></a>
                            </div>
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
