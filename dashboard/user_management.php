<?php
$servername = "localhost";
$username = "username"; // Replace with your MySQL username
$password = "password"; // Replace with your MySQL password
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['change_to_admin'])) {
    $username = $_POST['username'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        // User role successfully updated
        echo "<p class='message success'>User '$username' is now an admin.</p>";
    } else {
        // Error occurred during update
        echo "<p class='message error'>Error updating user role: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

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
    $username = $_POST['username'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        // User role successfully updated
        echo "<p class='message success'>User '$username' is now an admin.</p>";
    } else {
        // Error occurred during update
        echo "<p class='message error'>Error updating user role: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
