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

async function cameraReady() {
    await sleep(500, canvas);
    document.getElementsByClassName("content hidden")[0].classList.remove("hidden");
    console.log(video.videoWidth);
    console.log(video.videoHeight);
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
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
            cameraReady();
        }).catch(function (err) {
            console.log(err);
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}