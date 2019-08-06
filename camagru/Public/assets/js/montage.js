var front = false;
var video = null;
var canvas = null;
var context = null;

function montageReady() {
    video = document.getElementById('video');
    canvas = document.getElementById('render');
    context = canvas.getContext('2d');
    if (!mobileDevice)
        document.getElementsByClassName("reverse-cam")[0].classList.add("disable");
    setupCamera();
}

 function cameraReady() {
    document.getElementsByClassName("content hidden")[0].classList.remove("hidden");
}

function switchDevice() {
    event.preventDefault();
    if (mobileDevice) {
        front = !front;
        setupCamera();
    }
}

function updateSizes() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    document.getElementsByClassName("pics")[0].style.maxHeight = document.getElementsByClassName("montage-row")[0].clientHeight + "px";
}

function takePicture() {
    event.preventDefault();
    updateSizes();
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
}

function setupCamera() {
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: (mobileDevice ? {facingMode: (front? "user" : "environment")} : true) }).then(function(stream) {
            video.srcObject = stream;
            video.play();
            cameraReady();
        }).catch(function (err) {
            console.log(err);
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}