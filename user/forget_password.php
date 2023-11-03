<?php
// forget_password.php
if (isset($_POST['submit'])) {
    // Process the form submission
    // Generate a unique token, save it in the database, and send the email
    // ...
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Validate the token (check if it's valid and not expired)
    // If valid, allow the user to reset their password
    // ...
} else {
    echo "Invalid request. Please use the link provided in the email.";
}
?>



<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Validate email (you may want to add more thorough validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit();
    }

    // Check if the email exists in your database (you should have a users table)
    // If it exists, generate a unique token and send a password reset link to the user's email
    // You can use a library like PHPMailer for sending emails
    // Example code for sending email:
    /*
    $token = generateUniqueToken(); // You need to implement this function
    $reset_link = "http://example.com/reset_password.php?token=$token";
    $message = "Click the link below to reset your password:\n$reset_link";
    mail($email, "Password Reset", $message);
    */

    echo "An email with instructions to reset your password has been sent.";
}

$token = $_GET['token']; // Assuming the token is sent as a query parameter

// Validate the token (check if it's valid and not expired)
// If valid, allow the user to reset their password
// Otherwise, display an error message
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Forget Password</h1>
                    <form action="reset_password.php" method="post">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


