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