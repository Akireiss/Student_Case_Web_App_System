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

//
const actionTakenSelect = document.getElementById('action-taken');
const reminderInput = document.getElementById('reminder-input');

// Listen to changes in the select element
actionTakenSelect.addEventListener('change', function() {
    const selectedValue = actionTakenSelect.value;

    if (selectedValue === 'Resolved') {
        reminderInput.disabled = true; // Disable the input for 'Resolved'
    } else {
        reminderInput.disabled = false; // Enable the input for other values
    }
});

// Trigger the change event once to initialize the state based on the initial value
actionTakenSelect.dispatchEvent(new Event('change'));
