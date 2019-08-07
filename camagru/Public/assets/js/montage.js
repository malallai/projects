var front = false;
var video = null;
var canvas = null;
var context = null;
var filter = null;

function montageReady() {
    let parent = document.getElementsByClassName("render-overlay")[0];
    video = document.getElementById('video');
    canvas = document.getElementById('render');
    context = canvas.getContext('2d');
    if (!mobileDevice)
        document.getElementsByClassName("reverse-cam")[0].classList.add("disable");

    let buttons = parent.getElementsByClassName("overlay-button");
    for (let items of buttons) {
        items.addEventListener("click", function(event) {
            event.preventDefault();
            filter.removeProperty("selected");
            filter = items;
            filter.setProperty("selected", "");
        });
    }

    setupCamera();
}

 function cameraReady() {
}

function switchDevice() {
    event.preventDefault();
    if (mobileDevice) {
        front = !front;
        setupCamera();
    }
}

function takePicture() {
    event.preventDefault();
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
}

function setupCamera() {
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: (mobileDevice ? {facingMode: (front? "user" : "environment")} : true) }).then(function(stream) {
            video.srcObject = stream;
            video.play();
            video.oncanplay = function () {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
            };
            cameraReady();
        }).catch(function (err) {
            console.log(err);
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}