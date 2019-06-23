window.onload = function() {
    var login_button = document.getElementById('login-button');
    var register_button = document.getElementById('register-button');
    var reset_button = document.getElementById('reset-button');

    var login_content = document.getElementById('login-content');
    var register_content = document.getElementById('register-content');
    var reset_content = document.getElementById('reset-content');

    login_button.addEventListener("click", function() {
        clear_active();
        login_button.classList.add("active");
        login_content.classList.add("active");
    });
    register_button.addEventListener("click", function() {
        clear_active();
        register_button.classList.add("active");
        register_content.classList.add("active");
    });
    reset_button.addEventListener("click", function() {
        clear_active();
        reset_button.classList.add("active");
        reset_content.classList.add("active");
    });

    function clear_active() {
        login_button.classList.remove("active");
        register_button.classList.remove("active");
        reset_button.classList.remove("active");
        login_content.classList.remove("active");
        register_content.classList.remove("active");
        reset_content.classList.remove("active");
    }

};

