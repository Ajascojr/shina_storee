document.addEventListener('DOMContentLoaded', function () {
    const signinForm = document.getElementById('signin-form');
    const errorMsg = document.getElementById('error-msg');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    signinForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword) {
            errorMsg.textContent = 'Passwords do not match. Please try again.';
        } else {
            // Submit the form or perform other actions here
            // You can use AJAX to send the data to the server
            // Example: sendFormDataToServer(signinForm);
        }
    });
});
