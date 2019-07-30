function formReady() {
    let rowParent = document.getElementById("form-row");
    let navItems = rowParent.getElementsByClassName("nav-form-button");
    let formItems = rowParent.getElementsByClassName("form-content");
    for (let items of navItems) {
        items.addEventListener("click", function(event) {
            event.preventDefault();
            switchButtons(navItems, formItems, items);
        });
    }

    let checkbox = rowParent.getElementsByClassName("checkbox");
    for (let items of checkbox) {
        items.addEventListener("click", function(event){
            event.preventDefault();
            let checkbox = document.getElementById(event.srcElement.id);
            if (checkbox.checked) {
                event.srcElement.className = "fas fa-toggle-off red";
                checkbox.checked = false;
                checkbox.value = false;
            } else {
                event.srcElement.className = "fas fa-toggle-on green";
                checkbox.value = true;
            }
        });
    }
}

function switchButtons(navItems, formItems, event) {
    for (let forms of formItems) {
        forms.classList.remove("active");
    }
    for (let navs of navItems) {
        navs.classList.remove("active");
    }
    let formId = document.getElementById(event.id.split(' ')[1]);
    event.classList.add("active");
    formId.classList.add("active");
}