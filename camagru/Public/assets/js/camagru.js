var mobileDevice = false;

window.onload = async function() {
    let aside = document.getElementsByClassName("aside-row")[0];
    await sleep(500, aside);
    aside.classList.remove("hide");

    let list = document.getElementsByTagName("*");
    for (let item of list) {
        item.ondragstart = function () {return false;};
    }

    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        mobileDevice = true;
    }

    if (typeof postReady === "function") postReady();
    if (typeof formReady === "function") formReady();
    if (typeof montageReady === "function") montageReady();
};

function sleep(ms, div) {
    return new Promise(resolve => (div.id = setTimeout(resolve, ms)));
}

function overlay() {
    event.preventDefault();
    let body = document.getElementsByTagName("body")[0];
    body.removeAttribute("has_aside");
}

function user_aside() {
    event.preventDefault();
    let body = document.getElementsByTagName("body")[0];
    body.setAttribute("has_aside", "");
}

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}