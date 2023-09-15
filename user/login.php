<?php   require_once('../dashboard/includes/conn.php');

// $msg        = null;
$error      = null;
$email      = null;
$password   = null; 



if (isset($_POST['btn_login'])) {
   
    $email    = sanitize_var($my_conn, $_POST['email']);    // sanitizing users input
    $password = sanitize_var($my_conn, $_POST['password']);
    
    // check if the email is already registered
    $query = "SELECT * FROM user_tb WHERE email=?";
    $stmt = mysqli_prepare($my_conn, $query);       // prrepare the sql statement
    mysqli_stmt_bind_param($stmt, "s", $email);     // bind the parameters
    mysqli_stmt_execute($stmt);                     // execute the prepared statement
    $result = mysqli_stmt_get_result($stmt);        // get execution results 
    $n_row1 = mysqli_num_rows($result);             // get the number of rows returned

    if ($n_row1 > 0) {
        $rd = mysqli_fetch_array($result);           // fetching a row from the result
        $md_password = SALT_PREFIX . $password . SALT_SUFFIX;
        if (password_verify($md_password, $rd['password']) === true) {

            // save user info in session
            $_SESSION['first_name'] = $rd['first_name'];
            $_SESSION['last_name'] = $rd['last_name'];
            $_SESSION['email'] = $rd['email'];
            $_SESSION['telephone'] = $rd['telephone'];
            $_SESSION['user_type'] = $rd['user_type'];
            $_SESSION['user_id'] = $rd['id'];

            header('location:../dashboard/homepage.php');

        } else {
            $error = "Invalid email or password. Please try again.";
        }

        // } else {
        //     $msg = 'The credentials submitted does not match any of our records';
        // }
//     } else {
//         $msg = 'The credentials submitted does not match any of our records';
        
//     }
// }

} else {
            $error = "Invalid email or password. Please try again.";
        }
    }


?>


<?php
// session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = $_POST['email'];
//     $telephone = $_POST['telephone'];
//     $password = $_POST['password'];

//     // Perform server-side validation and authentication here.
//     // You should check against a database and hash the password in a real application.

//     if ($email === 'user@example.com' && $password === 'password123') {
//         $_SESSION['email'] = $email;
//         header('Location: ../dashboard/homepage.php'); // Redirect to a welcome page.
//         exit();
//     } else {
//         $error = "Invalid email or password. Please try again.";
//     }
// }
?>



<!-- Your HTML login form remains the same -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <!-- <link rel="stylesheet" href="../dist/css/bootstrap.min.css"> -->
</head>
<body>
       <?php
                    // ($msg!='') ? '<div class="alert alert-primary">'.$msg.'</div>' : ''
                    // if ($msg!='') { echo '<div class="alert alert-primary">'.$msg.'</div>'; }
                    ?> 

<?php
                    // ($msg!='') ? '<div class="alert alert-primary">'.$msg.'</div>' : ''
                    // if ($error!='') { echo '<div class="alert alert-primary">'.$error.'</div>'; }
        // if ($error!='') { echo ' <div id="error-msg" class="error message" style="color: red; margin-bottom: 10px;">'.$error.'</div>'; }
        // color: red;
        // margin-bottom: 10px;
                    ?> 
    <div class="login-container">
        <h1>Login</h1>
        <!-- <div id="error-msg" class="error-message"></div> -->
        <?php
        if ($error!='') { echo ' <div id="error-msg" class="error message" style="color: red; margin-bottom: 10px;">'.$error.'</div>'; }
        ?>
        <form id="login-form" method="post"> 

        <p class="text-center text-white pt-4">Don't have an account? <a href="signup.php">Register</a></p>

            <label for="email">Email:</label>
            <input type="email" id="email" value="<?php echo  $email?>"  name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" value="<?php echo  $password?>"  name="password" required>
            
            <button type="submit" name="btn_login">Login</button>

            <tr>
                                    <td colspan="2">
                                          <p class="mb-0 text-center">
                                              <a href="forget_password.php"> Forget Password</a>
                                          </p>
                                    </td>
                                </tr>
        </form>
    </div>
    
    <!-- <script src="login.js"></script> -->
</body>
</html>