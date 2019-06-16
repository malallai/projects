async function new_snackbar(message) {
    if (document.getElementById("snackbar").className !== "show"
        && document.getElementById("snackbar").className !== "hide") {
        document.getElementById("inner").innerHTML = document.getElementById("inner").innerHTML + "<div onclick='hideSnack();' id='snackbar'>" + message + "</div>";
        document.getElementById("snackbar").className = "show";
        await sleep(5000);
        hideSnack();
    }
}

async function hideSnack() {
    document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("show", "hide");
    await sleep(500);
    document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("hide", "");
}

function sleep(ms) {
    if (tmp)
        clearTimeout(tmp);
    return new Promise(resolve => (tmp = setTimeout(resolve, ms)));
}

