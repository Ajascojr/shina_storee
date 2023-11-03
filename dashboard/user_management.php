<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "commerce_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['change_to_admin'])) {
    $email = $_POST['email'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE user_tb SET user_type = 'admin' WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        // User type successfully updated
        echo "<p class='message alert alert-success'>User '$email' is now an admin.</p>";
    } else {
        // Error occurred during update
        echo "<p class='message alert alert-danger error'>Error updating user type: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Fetch emails from user_tb
$result = $conn->query("SELECT email FROM user_tb");

if ($result->num_rows > 0) {
    $emails = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $emails = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change User Type</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require_once('nav.php'); ?>
<h1>Change User Type</h1>

<div class="container mt-4">
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Select Email</label>
            <select class="form-control" id="email" name="email" required>
                <?php foreach($emails as $email) : ?>
                    <option value="<?= $email['email'] ?>"><?= $email['email'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="change_to_admin">Change to Admin</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
