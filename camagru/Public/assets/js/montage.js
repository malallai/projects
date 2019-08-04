var front = false;
function montageReady() {
    let video = document.getElementById("video");
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            video.srcObject = stream;
            video.play();
        }).catch(function (err) {
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}

function test() {
    event.preventDefault();
    front = !front;
    let video = document.getElementById("video");
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: {facingMode: (front? "user" : "environment")} }).then(function(stream) {
            video.srcObject = stream;
            video.play();
        }).catch(function (err) {
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}