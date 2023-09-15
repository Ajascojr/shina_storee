<?php 

// $_SESSION['user_type'] = $rd['user_type'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nav.css">
    <title>My E-commerce Website</title>
</head>
<body>

<!-- ... (previous HTML code) ... -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">E-commerce</div>
            <ul class="nav-links">
                <li><a href="homepage.php">Home</a></li>
                <?php
                $user_type = $_SESSION['user_type'];
                if ($user_type==='admin') {
                   echo ' <li>
                         <a href="admin_board.php">Admin Board</a>
                    </li>';
                }
            ?> 
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
            <div class="user-actions">
                <?php
                session_start();

                if (isset($_SESSION['user_id'])) {
                    echo '<a href="../user/login.php">Logout</a>';
                } 
                // else {
                //     echo '<a href="../user/login.php">Login</a>';
                // }
                ?>
            </div>
        </div>
    </nav>

    <!-- <script src="nav.js"></script> -->
</body>
</html>



