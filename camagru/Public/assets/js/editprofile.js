function editProfileReady() {
    let global = document.getElementById("global-content");
    global.addEventListener("submit", function (event){
        editProfile("global", global);
    });
    let password = document.getElementById("edit-pwd-content");
    password.addEventListener("submit", function (event){
        editProfile("password", password);
    });
}

function editProfile(type) {
    event.preventDefault();
    let form = event.target;
    let url = '/user/edit';
    let token = document.getElementsByClassName("token")[0];
    let data;
    if (type === "global") {
        data = {
            token: token,
            first_name: form['first_name'].value,
            last_name: form['last_name'].value,
            mail: form['mail'].value,
            password: form['password'].value,
            type: type
        };
    } else if (type === "password") {
        data = {
            token: token,
            password: form['password'].value,
            new_password: form['new_password'].value,
            repeat: form['repeat'].value,
            type: type
        };
    }
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (msg) {
            console.log(msg);
        }
    });
}