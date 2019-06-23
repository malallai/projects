async function new_snackbar(message) {
    let snacks;
    if (document.getElementsByClassName("snacks").length !== 0) {
        snacks = document.getElementsByClassName("snacks")[0];
    } else {
        snacks = document.createElement("div");
        snacks.className = "snacks";
    }
    let div = document.createElement("div");
    div.className = "show-anim snackflex";
    div.addEventListener("click", function () {
        hideSnack(this);
    });
    let child = document.createElement("div");
    child.className = "snackbar";
    child.innerHTML = message;
    div.prepend(child);
    snacks.append(div);
    document.getElementById("inner").prepend(snacks);
    await sleep(500, div);
    div.className = div.className.replace("show-anim", "show");
    await sleep(4500, div);
    hideSnack(div);
}

async function hideSnack(div) {
    clearTimeout(div.id);
    div.className = div.className.replace("show", "hide-anim");
    await sleep(500, div);
    div.remove();
}

function sleep(ms, div) {
    return new Promise(resolve => (div.id = setTimeout(resolve, ms)));
}

function overlay() {
    var body = document.getElementsByTagName("body")[0];
    var overlay = document.getElementsByClassName("overlay")[0];

    overlay.addEventListener("click", function () {
        body.removeAttribute("has_aside");
    });
}

function user_aside() {
    var body = document.getElementsByTagName("body")[0];
    var aside_button = document.getElementsByClassName("user-aside")[0];

    aside_button.addEventListener("click", function () {
        body.setAttribute("has_aside", "");
    });
}