<?php
require_once('../dashboard/includes/conn.php');

$first_name = '';
$last_name = '';
$email = '';
$telephone = '';
$password = '';
$msg = '';
$error = '';

if (isset($_POST['btn_signup'])) {
    $first_name = sanitize_var($my_conn, $_POST['first_name']);
    $last_name = sanitize_var($my_conn, $_POST['last_name']);
    $email = sanitize_var($my_conn, $_POST['email']);
    $telephone = sanitize_var($my_conn, $_POST['telephone']);
    $password = sanitize_var($my_conn, $_POST['password']);
    $c_password = sanitize_var($my_conn, $_POST['confirm_password']);
    $usr_type = 'standard';

    if ($password === $c_password) {
        // Hash the user password securely
        $hashed_pword = password_hash(SALT_PREFIX . $password . SALT_SUFFIX, PASSWORD_BCRYPT);

        // Check if the email is already registered
        $query = "SELECT id FROM user_tb WHERE email=?";
        $stmt = mysqli_prepare($my_conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $n_row1 = mysqli_num_rows($result);
        
        // header('location:../dashboard/homepage.php');

        if ($n_row1 > 0) {
            $error = "This email already exists with us. Please login if you've registered before.";
        } else {
            $sql = "INSERT INTO user_tb (first_name, last_name, email, telephone, user_type, password) VALUES (?, ?, ?, ?, ? , ?)";
            $stmt = mysqli_prepare($my_conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $email, $telephone, $usr_type, $hashed_pword);
            mysqli_stmt_execute($stmt);
            $n_row2 = mysqli_stmt_affected_rows($stmt);
            if ($n_row2 > 0) {
                $msg = 'Record saved successfully';
            } else {
                $error = 'Something went wrong, please try again!';
            }
        }
    } else {
        $error = "Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <!-- <link rel="stylesheet" href="../dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <form action="" method="post">
        <div class="signin-container">
            <h1>Sign Up</h1>
            <?php
            if ($msg != '') {
                echo '<div class="alert alert-primary" style="color: blue; margin-bottom: 10px;">' . $msg . '</div>';
            }
            if ($error != '') {
                echo ' <div id="error-msg" class="alert alert-danger error message" style="color: red; margin-bottom: 10px;">' . $error . '</div>';
            }
            ?>

            <p class="text-center pt-4">Already have an account? <a href="login.php">Login</a></p>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input type="telephone" id="telephone" name="telephone" required style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="btn_signup">Sign Up</button>
        </div>
    </form>
</body>
</html>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>