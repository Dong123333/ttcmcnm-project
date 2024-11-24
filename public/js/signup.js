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

function toggleConfirmPassword() {
    const confirmPasswordField = document.getElementById("confirmPassword");
    const confirmPasswordIcon = document.getElementById("confirmPasswordIcon");
    if (confirmPasswordField.type === "password") {
        confirmPasswordField.type = "text";
        confirmPasswordIcon.src = "images/eye.svg";
    } else {
        confirmPasswordField.type = "password";
        confirmPasswordIcon.src = "images/eye-close.svg";
    }
}
