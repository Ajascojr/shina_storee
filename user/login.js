document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const errorMsg = document.getElementById('error-msg');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // You should perform server-side validation and authentication here.
        // For this example, let's assume a basic check.
        if (email === 'user@example.com' && password === 'password123') {
            // Redirect to a welcome page or perform other actions on successful login.
            window.location.href = 'welcome.php';
        } else {
            errorMsg.textContent = 'Invalid email or password. Please try again.';
        }
    });
});
