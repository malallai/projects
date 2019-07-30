function formReady() {
    let rowParent = document.getElementsByClassName("row")[0];
    let navItems = rowParent.getElementsByClassName("nav-form-button");
    let formItems = rowParent.getElementsByClassName("form-content");
    for (let items of navItems) {
        items.addEventListener("click", function(event) {
            event.preventDefault();
            switchButtons(navItems, formItems, event);
        });
    }
}

function switchButtons(navItems, formItems, event) {
    for (let forms of formItems) {
        forms.classList.remove("active");
    }
    for (let navs of formItems) {
        navs.classList.remove("active");
    }
    let navId = event.srcElement;
    let formId = document.getElementById(navId.id.split(' ')[1]);
    navId.classList.add("active");
    formId.classList.add("active");
}