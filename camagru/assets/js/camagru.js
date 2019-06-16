let tmp;
async function new_snackbar(message) {
    if (document.getElementById("snackbar") === null) {
        document.getElementById("inner").innerHTML = document.getElementById("inner").innerHTML + "<div id='snackbar'><div onclick='hideSnack();' id='snackbar-message'>" + message + "</div></div>";
        document.getElementById("snackbar").className = "show";
        await sleep(5000);
        hideSnack();
    }
}

async function hideSnack() {
    document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("show", "hide");
    await sleep(500);
    document.getElementById("snackbar").remove();
}

function sleep(ms) {
    if (tmp)
        clearTimeout(tmp);
    return new Promise(resolve => (tmp = setTimeout(resolve, ms)));
}

