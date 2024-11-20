function togglePassword() {
    const passwordField = document.getElementById("password");
    const passwordIcon = document.getElementById("passwordIcon");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordIcon.src = "images/eye.svg";
    } else {
        passwordField.type = "password";
        passwordIcon.src = "images/eye-close.svg";
    }
}
