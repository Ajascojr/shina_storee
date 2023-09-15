document.addEventListener('DOMContentLoaded', function () {
    const logoutLink = document.getElementById('logout-link');

    if (logoutLink) {
        logoutLink.addEventListener('click', function (event) {
            event.preventDefault();

            // Ask for confirmation before logging out
            const confirmLogout = confirm('Are you sure you want to logout?');
            if (confirmLogout) {
                // Redirect to the logout PHP script
                window.location.href = 'logout.php'; // Replace with your actual logout script
            }
        });
    }
});
