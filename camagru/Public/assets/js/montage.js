var front = false;
var video = null;
var canvas = null;
var context = null;
var montage = {selectedFilter:null, selectedPicture:null, took:false, filterId:0}
var pictureFilter = {picked:false, img:null, clickedX:0, clickedY:0, width:50, x:25, y:0};

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
            if (montage.selectedFilter) montage.selectedFilter.removeAttribute("selected");
            montage.selectedFilter = items;
            montage.selectedFilter.setAttribute("selected", "");
            updateFilter();
        });
    }

    document.getElementsByClassName("render")[0].addEventListener("mousemove", movePicture);
    document.getElementById('import').addEventListener('input', importPic);

    setupCamera();
}

function movePicture(event) {
    if (pictureFilter.picked) {
        let rect = canvas.getBoundingClientRect();
        let x = event.clientX - rect.left - pictureFilter.clickedX;
        let y = event.clientY - rect.top - pictureFilter.clickedY;
        let top = 100 * y / canvas.offsetHeight;
        let left = 100 * x / canvas.offsetWidth;
        pictureFilter.x = left;
        pictureFilter.y = top;
        pictureFilter.img.style.top = pictureFilter.y + '%';
        pictureFilter.img.style.left = pictureFilter.x + '%';
    }
}

function importPic() {
    let input =  document.getElementById('import');
    let file = input.files[0];
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        let img = new Image();
        img.src = reader.result;
        img.onload = () => {
            canvas.width = img.width;
            canvas.height = img.height;
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
            newPicture();
        };
    };
}

function switchFilters() {
    let render = document.getElementsByClassName("render")[0];
    let button = document.getElementsByClassName("filters-button")[0];
    let filters = button.classList.contains('button-green');
    filters = !filters;
    if (!filters)
        render.setAttribute("hide_filters", "");
    else render.removeAttribute("hide_filters");
    button.className = button.className.replace(filters ? "red" : "green", filters ? "green" : "red");
}

function reloadImage() {
    let image = new Image();
    image.src = montage.selectedFilter.src;
    context.drawImage(montage.selectedFilter, 0, 0, canvas.width, canvas.height);
}

function updateFilter() {
    if (montage.selectedFilter) {
        montage.filterId = montage.selectedFilter.children[0].id;
        checkFilters();
        switch (montage.filterId) {
            case "sepia":
                document.getElementById('render').style.filter = "sepia(1)";
                break;
            case "gray":
                document.getElementById('render').style.filter = "grayscale(1)";
                break;
            case "42":
                picFilter(document.getElementById('pic-' + montage.filterId));
                break;
            default: break;
        }
    }
}

function checkFilters() {
    document.getElementById('render').style.filter = "";
    if (pictureFilter.img) {
        pictureFilter.img.remove();
        pictureFilter.img = null;
    }
}

function picFilter(parent) {
    let img = new Image();
    img.src = parent.src;
    img.classList.add("filter-img");
    img.style.width = pictureFilter.width + '%';
    img.style.left = pictureFilter.x + '%';
    img.style.top = pictureFilter.y + '%';
    pictureFilter.img = img;
    img.addEventListener("mousedown", event => {
        pictureFilter.picked = true;
        pictureFilter.clickedX = event.layerX;
        pictureFilter.clickedY = event.layerY;
    });
    img.addEventListener("mouseup", event => {
        pictureFilter.picked = false;
    });
    document.getElementsByClassName("render")[0].prepend(img);
}

function deletePic(pic) {
    document.getElementById(pic.id).remove();
}

function takePicture() {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    newPicture();
}

function newPicture() {
    montage.took = true;
    let pictures = document.getElementsByClassName("pics")[0];
    let newPic = document.createElement("div");
    let pic = document.createElement("canvas");
    let details = document.getElementById("default-details").children[0].cloneNode(true);
    let id = getRandomInt(9999);
    pic.width = canvas.width;
    pic.height = canvas.height;
    newPic.classList.add("pic");
    newPic.id = id + '';
    details.id = id + '';
    newPic.append(pic);
    newPic.append(details);
    pictures.prepend(newPic);
    montage.selectedFilter = newPic.children[0];
    let tmp = new Image();
    tmp.src = canvas.toDataURL();
    tmp.onload = () => {
        pic.getContext('2d').drawImage(tmp, 0, 0, pic.width, pic.height);
    };
    newPic.addEventListener("click", () => {
        if (montage.selectedFilter) montage.selectedFilter.removeAttribute("selected");
        montage.selectedFilter = newPic.children[0];
        montage.selectedFilter.setAttribute("selected", "");
        reloadImage();
    });
}

function switchCamera() {
    if (mobileDevice) {
        front = !front;
        setupCamera();
    }
}

function uploadMontage() {
    if (!montage.took)
        return;
    let token = document.getElementsByClassName("token")[0];
    let tmp = document.createElement('canvas');
    let context = tmp.getContext('2d');
    tmp.height = pictureFilter.img.naturalHeight;
    tmp.width = pictureFilter.img.naturalWidth;
    context.drawImage(pictureFilter.img, 0, 0);
    $.ajax({
        url: '/montage/upload',
        type: 'POST',
        dataType: 'json',
        data: {
            img: canvas.toDataURL("image/jpeg"),
            filter: montage.filterId,
            filterPicture: tmp.toDataURL('image/jpeg'),
            filterPictureSize: pictureFilter.width,
            filterPictureX: pictureFilter.x,
            filterPictureY: pictureFilter.y,
            token: token.value
        },
        success: function (msg) {
            console.log(msg);
        }
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
            noCamera();
        });
    } else {
        noCamera();
    }
}

function noCamera() {
    document.getElementsByClassName("video-overlay")[0].classList.add("hidden");
    document.getElementsByClassName("no-cam-overlay")[0].classList.remove("hidden");
}

function hideCamera() {
    if (document.getElementById('video').style.opacity == 0)
        document.getElementById('video').style.opacity = '1';
    else
        document.getElementById('video').style.opacity = '0';
}