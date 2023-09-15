<?php   require_once('../dashboard/includes/conn.php');

$first_name = null;  
$last_name  = null;
$email      = null;
$telephone  = null;
$password   = null;
$msg        = null;
$error      = null;




if (isset($_POST['btn_signup'])) {
    
    $first_name = sanitize_var($my_conn, $_POST['first_name']);
    $last_name  = sanitize_var($my_conn, $_POST['last_name']);
    $email      = sanitize_var($my_conn, $_POST['email']);
    $telephone  = sanitize_var($my_conn, $_POST['telephone']);
    $password   = sanitize_var($my_conn, $_POST['password']);
    $c_password = sanitize_var($my_conn, $_POST['confirm_password']);

    if ($password === $c_password) {

        // Hash the user password with the salts using the BCRYPT algorithm
        $hashed_pword = password_hash(SALT_PREFIX . $password . SALT_SUFFIX, PASSWORD_BCRYPT);
        
        // Check if the email is already registered
        $query = "SELECT id FROM user_tb WHERE email=?";
        $stmt = mysqli_prepare($my_conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $n_row1 = mysqli_num_rows($result);

        if ($n_row1 > 0) {
            $error .= "This email already exists with us. Please login if you've registered before.";
        } else {
            $sql = "INSERT INTO user_tb (first_name, last_name, email, telephone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($my_conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $email, $telephone, $hashed_pword);
            mysqli_stmt_execute($stmt);
            $n_row2 = mysqli_stmt_affected_rows($stmt);
            if ($n_row2 > 0) {
                $msg .= 'Record saved successfully';
            } else {
                $error .= 'Something went wrong, please try again!';

            }
        }
        } else {
                // Handle database error
        $error .= "Passwords do not match. Please try again.";

            }
    
        }
    

?>

<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $first_name = $_POST['first_name'];
//     $last_name = $_POST['last_name'];
//     $email = $_POST['email'];
//     $telephone = $_POST['telephone'];
//     $password = $_POST['password'];
//     $confirm_password = $_POST['confirm_password'];

//     // Server-side validation: Check if passwords match
//     if ($password !== $confirm_password) {
//         $error = "Passwords do not match. Please try again.";
//     } else {
//         // Passwords match, proceed with other actions
//         // You can add further validation and database storage here

//         // Example: Hash the password (you should use password_hash in a real scenario)
//         // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//         // Redirect to a success page or perform other actions
//         header('Location: success.php');
//         exit();
//     }
// }
?>

<?php
// Database connection configuration
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "commerce_db";


// // Create a database connection
// $conn = new mysqli($servername, $username, $password, $database);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Function to securely hash the password
// function hashPassword($password) {
//     return password_hash($password, PASSWORD_BCRYPT);
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $first_name = $_POST['first_name'];
//     $last_name = $_POST['last_name'];
//     $email = $_POST['email'];
//     $telephone = $_POST['telephone'];
//     $password = $_POST['password'];
//     $confirm_password = $_POST['confirm_password'];

//     // Server-side validation: Check if passwords match
//     if ($password !== $confirm_password) {
//         $error = "Passwords do not match. Please try again.";
//     } else {
//         // Passwords match, proceed with other actions
//     }

//         // Proceed with database insertion
//         $hashed_password = hashPassword($password);
//        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
// $user_type = "standard";

//         $sql = "INSERT INTO user_tb (first_name, last_name, user_type, email, telephone, password)
//                 VALUES (?, ?, ?, ?, ?, ?)";

//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ssssss", $first_name, $last_name, $user_type, $email, $telephone, $hashed_password);

//         if ($stmt->execute()) {
//             // User registration successful
//             // header("Location: ../dashboard/homepage.php");
//             exit();
//         } else {
//             // Handle database error
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }

//         $stmt->close();
//     }


?>

<!-- Your HTML signup form remains the same -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <!-- <link rel="stylesheet" href="../dist/css/bootstrap.min.css"> -->
</head>
<body>
    <form action="" method="post">
      <div class="signin-container">
        <h1>Sign Up</h1>
        <?php
                    // ($msg!='') ? '<div class="alert alert-primary">'.$msg.'</div>' : ''
                    if ($msg!='') { echo '<div class="alert alert-primary" style="color: blue; margin-bottom: 10px;">'.$msg.'</div>'; }
                    // if ($error!='') { echo '<div class="alert alert-primary">'.$error.'</div>'; }
        if ($error!='') { echo ' <div id="error-msg" class="error message" style="color: red; margin-bottom: 10px;">'.$error.'</div>'; }



                    
        // if ($stmt->execute()) {
        //     // User registration successful
        //     // header("Location: ../dashboard/homepage.php");
        //     exit();
        // } else {
        //     // Handle database error
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        // $stmt->close();
        ?> 




        <div id="error-msg" class="error-message"></div>
        <form id="signin-form">

        <p class="text-center text-white pt-4">Already have an account? <a href="login.php">Login</a></p>

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
        </form>
    </div>  
    </form>
    
    
    <!-- <script src="signup.js"></script> -->
</body>
</html>

