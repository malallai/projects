function editProfileReady() {
    document.getElementById("global-content").addEventListener("submit", function (event){
        editProfile("global");
    });

    document.getElementById("edit-pwd-content").addEventListener("submit", function (event){
        editProfile("password");
    });
}

function editProfile(type) {
    event.preventDefault();
    console.log(event);
    let data;
    let token = document.getElementsByClassName("token")[0];
    if (type === "global") {
        data = {
            token: token
        };
    } else if (type === "password") {

    }
}