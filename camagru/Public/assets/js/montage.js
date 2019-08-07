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
            if (filter) filter.removeAttribute("selected");
            filter = items;
            filter.setAttribute("selected", "");
            updateFilter();
        });
    }

    setupCamera();
}

function reloadImage() {
    let temp = document.getElementsByClassName("pics")[0].children[0].children[0].children[0].src;
    let img = new Image();
    img.src = temp;
    img.onload = function () {
        context.drawImage(img, 0, 0, canvas.width, canvas.height);
    };
}

function turn_gray(my_context) {
    var imageData = my_context.getImageData(0, 0, canvas.width, canvas.height);
    for (j = 0; j < imageData.height; j++) {
        for (i = 0; i < imageData.width; i++) {
            var index = (j * 4) * imageData.width + (i * 4);
            var red = imageData.data[index];
            var green = imageData.data[index + 1];
            var blue = imageData.data[index + 2];
            var average = (red + green + blue) / 3;
            imageData.data[index] = average;
            imageData.data[index + 1] = average;
            imageData.data[index + 2] = average;
        }
    }
    my_context.putImageData(imageData, 0, 0);
}

function updateFilter() {
    if (filter) {
        switch (filter.children[0].id) {
            case "void":
                break;
            case "sepia":
                reloadImage();
                turn_gray(context);
                break;
            case "gray":
                reloadImage();
                turn_gray(context);
                break;
            case "42":
                let img = new Image();
                img.src = filter.children[0].children[1].src;
                img.onload = function(){
                    context.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                break;
            default: break;
        }
    }
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
        }).catch(function (err) {
            console.log(err);
            console.log("no camera");
        });
    } else {
        console.log("no camera");
    }
}