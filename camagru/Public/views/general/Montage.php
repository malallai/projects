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
                                <div class="filter" id="void">
                                    <img src="">
                                </div>
                            </div>
                            <div class="overlay-button">
                                <div class="filter" id="gray">
                                    <img src="/Public/assets/pictures/filters/gray.jpg">
                                </div>
                            </div>
                            <div class="overlay-button">
                                <div class="filter" id="sepia">
                                    <img src="/Public/assets/pictures/filters/sepia.jpg">
                                </div>
                            </div>
                            <div class="overlay-button">
                                <div class="filter" id="42">
                                    <img src="/Public/assets/pictures/filters/42.png">
                                    <img src="/Public/assets/pictures/filters/42-filter.png" class="hidden">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="pics-row" class="row pics-row">
        <div class="content">
            <div class="row-title">
                <p>Photos précédentes</p>
            </div>
            <div class="pics">
                <div id="default-details" class="hidden">
                    <div class="details" onclick="deletePic(this)">
                        <div class="row">
                            <div class="content">
                                <span class="delete-post">
                                    <a href="#"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="buttons-row" class="row buttons-row">
        <div class="montage-button button-blue">
            <div class="button-content">
                <a href="#"><span>Envoyer</span></a>
            </div>
            <div class="button-content">
                <a href="#"><span>Importer</span></a>
            </div>
        </div>
        <div class="montage-button filters-button button-green">
            <div class="button-content">
                <a href="#" onclick="switchFilters()"><span>Filtres</span></a>
            </div>
        </div>
    </div>
</div>
