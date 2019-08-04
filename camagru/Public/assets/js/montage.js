var front = false;
function montageReady() {
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

function setupCamera() {
    let video = document.getElementById("video");
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: (mobileDevice ? {facingMode: (front? "user" : "environment")} : true) }).then(function(stream) {
            video.srcObject = stream;
            video.play();
            cameraReady();
        }).catch(function (err) {
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}