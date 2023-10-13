function checkPasswordsMatch() {
    const passwordInput = document.getElementById("password");
    const repeatPasswordInput = document.getElementById("repeat-password");
    const passwordMismatchMessage = document.querySelector(
        '[x-show="passwordMismatch"]'
    );

    if (passwordInput.value !== repeatPasswordInput.value) {
        passwordMismatchMessage.style.display = "block";
        event.preventDefault(); // Prevent form submission
    } else {
        passwordMismatchMessage.style.display = "none";
    }
}

