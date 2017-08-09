window.onload = setup;

function setup() {
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
}

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
}
