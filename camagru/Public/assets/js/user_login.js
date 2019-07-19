function login_click() {
    let login_button = document.getElementById('login-button');
    let login_content = document.getElementById('login-content');
    event.preventDefault();
    clear_active();
    login_button.classList.add("active");
    login_content.classList.add("active");
}

function register_click() {
    let register_button = document.getElementById('register-button');
    let register_content = document.getElementById('register-content');
    event.preventDefault();
    clear_active();
    register_button.classList.add("active");
    register_content.classList.add("active");
}

function reset_click() {
    let reset_button = document.getElementById('reset-button');
    let reset_content = document.getElementById('reset-content');
    event.preventDefault();
    clear_active();
    reset_button.classList.add("active");
    reset_content.classList.add("active");
}

function clear_active() {
    let login_button = document.getElementById('login-button');
    let register_button = document.getElementById('register-button');
    let reset_button = document.getElementById('reset-button');

    let login_content = document.getElementById('login-content');
    let register_content = document.getElementById('register-content');
    let reset_content = document.getElementById('reset-content');

    login_button.classList.remove("active");
    register_button.classList.remove("active");
    reset_button.classList.remove("active");
    login_content.classList.remove("active");
    register_content.classList.remove("active");
    reset_content.classList.remove("active");
}
