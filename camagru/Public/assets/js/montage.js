var front = false;
var video = null;
var canvas = null;
var context = null;
var filter = null;
var picture = null;
var filters = true;
var filter_pick = false;
var filter_img = null;

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

    canvas.addEventListener("mousemove", e => {
        let rect = canvas.getBoundingClientRect();
        let x = e.clientX - rect.left;
        let y = e.clientY - rect.top;
        let top = 100 * canvas.offsetTop / y;
        let left = 100 * canvas.offsetLeft / x;
        console.log(top + ' ' + left);
        console.log(x + ' ' + y);
        if (filter_pick) {
            let rect = canvas.getBoundingClientRect();
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;
            let top = 100 * canvas.offsetTop / y;
            let left = 100 * canvas.offsetLeft / x;
            filter_img.style.top = top + '%';
            filter_img.style.left = left + '%';
            console.log(top);
            console.log(left);
        }
    });

    setupCamera();
}

function switchFilters() {
    event.preventDefault();
    let render = document.getElementsByClassName("render")[0];
    let button = document.getElementsByClassName("filters-button")[0];
    filters = !filters;
    if (!filters)
        render.setAttribute("hide_filters", "");
    else render.removeAttribute("hide_filters");
    button.className = button.className.replace(filters ? "red" : "green", filters ? "green" : "red");
}

function reloadImage() {
    let image = new Image();
    image.src = picture.src;
    context.drawImage(picture, 0, 0, canvas.width, canvas.height);
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
        reloadImage();
        switch (filter.children[0].id) {
            case "void":
                break;
            case "sepia":
                turn_gray(context);
                break;
            case "gray":
                turn_gray(context);
                break;
            case "42":
                let img = new Image();
                img.src = filter.children[0].children[1].src;
                img.classList.add("filter-img");
                img.style.width = '50%';
                img.style.left = '25%';
                img.style.top = '0';
                filter_img = img;
                img.addEventListener("click", () => {
                    filter_pick = !filter_pick;
                });
                document.getElementsByClassName("render")[0].prepend(img);
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

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

function deletePic(pic) {
    document.getElementById(pic.id).remove();
}

function takePicture() {
    event.preventDefault();
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    let pictures = document.getElementsByClassName("pics")[0];
    let newPic = document.createElement("div");
    let pic = document.createElement("canvas");
    let details = document.getElementById("default-details").children[0].cloneNode(true);
    let id = getRandomInt(9999);
    pic.width = video.videoWidth;
    pic.height = video.videoHeight;
    newPic.classList.add("pic");
    newPic.id = id + '';
    details.id = id + '';
    newPic.append(pic);
    newPic.append(details);
    pictures.prepend(newPic);
    picture = newPic.children[0];
    pic.getContext('2d').drawImage(video, 0, 0, pic.width, pic.height);
    newPic.addEventListener("click", () => {
        if (picture)
            picture.removeAttribute("selected");
        picture = newPic.children[0];
        picture.setAttribute("selected", "");
        updateFilter();
    });
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