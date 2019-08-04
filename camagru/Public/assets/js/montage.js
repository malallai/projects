function montageReady() {
    let video = document.getElementById("video");
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            video.srcObject = stream;
            video.play();
            camera_setup();
        }).catch(function (err) {
            no_camera();
        });
    } else {
        no_camera();
    }
}