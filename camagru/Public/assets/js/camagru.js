window.onload = async function() {
    let aside = document.getElementsByClassName("aside-row")[0];
    await sleep(500, aside);
    aside.classList.remove("hide");

    let list = document.getElementsByTagName("*");
    for (let item of list) {
        item.ondragstart = function () {return false;};
    }

    postLoad();
};

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
    document.getElementsByTagName("main")[0].prepend(snacks);
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
    event.preventDefault();
    let body = document.getElementsByTagName("body")[0];
    body.removeAttribute("has_aside");
}

function user_aside() {
    event.preventDefault();
    let body = document.getElementsByTagName("body")[0];
    body.setAttribute("has_aside", "");
}
