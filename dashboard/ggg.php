<?php
// session_start();

// Assuming you have a connection to your database
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "commerce_db"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a product has been added to the cart
if(isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $_SESSION['cart'][] = $product_id; // Add the product to the cart session
}

// Check if a product has been removed from the cart
if(isset($_GET['remove_from_cart'])) {
    $product_id = $_GET['remove_from_cart'];
    // Remove the product from the cart session
    $_SESSION['cart'] = array_diff($_SESSION['cart'], array($product_id));
}

// Get the list of products from the database
$sql = "SELECT * FROM product_tb";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- <link rel="stylesheet" href="styles.css"> Add your CSS file if needed -->
</head>

<style>
    /* body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
}

.product-list, .cart {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-gap: 20px;
}

.product, .cart-item {
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.product h2, .cart-item h2 {
    font-size: 1.2em;
    margin: 10px 0;
}

.product p, .cart-item p {
    font-size: 1em;
    margin: 10px 0;
}

form {
    display: inline-block;
    margin-top: 10px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 12px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
} */

</style>

<body>
    <?php require_once('nav.php'); ?>

    <div class="container">
        <h1>Products</h1>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $product_id = $row['id'];
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];

                // Check if the product is already in the cart
                $in_cart = in_array($product_id, $_SESSION['cart'] ?? []);

                echo '<div class="product">';
                echo '<h3>' . $product_name . '</h3>';
                echo '<p>Price: $' . $product_price . '</p>';

                if (!$in_cart) {
                    echo '<a href="?add_to_cart=' . $product_id . '">Add to Cart</a>';
                } else {
                    echo '<a href="?remove_from_cart=' . $product_id . '">Remove from Cart</a>';
                }

                echo '</div>';
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>
</body>
</html
