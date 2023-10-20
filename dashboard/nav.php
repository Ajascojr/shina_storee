<?php 
session_start();

    $user = $_SESSION['user_type'];


?>
    <link rel="stylesheet" href="nav.css">

<!-- ... (previous HTML code) ... -->
    <nav class="navbar mx-0 w-100">
        <div class="container">
            <div class="logo">E-commerce</div>
            <ul class="nav-links">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <?php 
                if ($user == 'admin') echo'<li><a href="admin_board.php">Admin</a></li>';
                ?>
            </ul>
            <div class="user-actions">
                <?php

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


