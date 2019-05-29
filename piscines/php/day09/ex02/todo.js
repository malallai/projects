var button = document.getElementById("new");
button.onclick = todo;
window.onload = getCookies;
var g_index = 0;

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=-999;';
}

function getCookies() {
    var cookies = document.cookie;
    if (cookies) {
        var tab = cookies.split(";");
        for (elem in tab) {
            var name = tab[elem].split("=")[0];
            var text = decodeURIComponent(tab[elem].split("=")[1]);
            var list = document.getElementById('ft_list');
            var input = document.createTextNode(text);
            var attribute = document.createElement("div");
            attribute.setAttribute("id", "ft_list");
            attribute.setAttribute("index", g_index);
            attribute.setAttribute("onclick", "del(this)");
            attribute.appendChild(input);
            list.insertBefore(attribute, list.firstChild);
            eraseCookie(name);
            setCookie('todo' + g_index, encodeURIComponent(text), 1);
            g_index++;
        }
    }
}

function todo() {
    var text = prompt("Todo:");
    if (text.length > 0) {
        var list = document.getElementById('ft_list');
        var input = document.createTextNode(text);
        var attribute = document.createElement("div");
        attribute.setAttribute("id", "ft_list");
        attribute.setAttribute("index", g_index);
        attribute.setAttribute("onclick", "del(this)");
        attribute.appendChild(input);
        list.insertBefore(attribute, list.firstChild);
        setCookie('todo' + g_index, encodeURIComponent(text), 1);
        g_index++;
    }
}

function del(elem) {
    if (confirm("Delete ?") === true) {
        index = elem.getAttribute("index");
        document.getElementById('ft_list').removeChild(elem);
        eraseCookie('todo' + index);
    }
}