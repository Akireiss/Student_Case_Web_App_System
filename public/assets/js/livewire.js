function formatPhoneNumber() {
    // Get the current value of the phone number input
    let phoneNumber = document.querySelector('[x-model="phoneNumber"]').value;

    // Remove all non-numeric characters
    phoneNumber = phoneNumber.replace(/\D/g, '');

    // Check if the phone number starts with "09" and has 10 digits
    if (phoneNumber.startsWith('09') && phoneNumber.length === 10) {
        // Format the phone number as (XXX) XXX-XXXX
        phoneNumber = phoneNumber.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    }

    // Update the input field with the formatted phone number
    document.querySelector('[x-model="phoneNumber"]').value = phoneNumber;
}
