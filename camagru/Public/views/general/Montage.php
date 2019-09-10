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
                                <a onclick="hideCamera()" class="a-button"><i class="fas fa-toggle-off"></i></a>
                            </div>
                            <div class="overlay-button take-picture">
                                <a onclick="takePicture()" class="a-button"><i id="0" class="far fa-circle"></i></a>
                            </div>
                            <div class="overlay-button reverse-cam">
                                <a onclick="switchCamera()" class="a-button"><i id="0" class="fas fa-retweet"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="montage-overlay no-cam-overlay hidden">
                    <div class="row">
                        <div class="content">
                            <p>La caméra est inaccessible.</p>
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
                                    <img id='icon-42' src="/Public/assets/pictures/filters/42.png">
                                    <img id='pic-42' src="/Public/assets/pictures/filters/42-filter.png" class="hidden">
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
                                    <a class="a-button"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="buttons-row" class="row buttons-row">
        <div class="c-button montage-button">
            <div class="button-content button-blue">
                <a class="a-button" onclick="uploadMontage()"><span>Envoyer</span></a>
            </div>
            <div class="button-content button-blue">
                <label for="import"><span>Importer</span></label>
                <input type="file" id="import" name="picture" accept="image/*">
            </div>
        </div>
        <div class="c-button filters-button">
            <div class="range-slider button-blue">
                <input type="range" min="1" max="10" value="1" class="slider" id="ratio">
            </div>
            <div class="button-content button-green">
                <a onclick="switchFilters()" class="a-button"><span>Filtres</span></a>
            </div>
        </div>
    </div>
</div>
