<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Product</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "commerce_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['delete_product'])) {
    $productToDelete = $_POST['product_to_delete'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM product_tb WHERE product_name = ?");
    $stmt->bind_param("s", $productToDelete);

    if ($stmt->execute()) {
        // Product successfully deleted
        echo "<p class='message success'>Product '$productToDelete' has been successfully deleted.</p>";
    } else {
        // Error occurred during deletion
        echo "<p class='message error'>Error deleting product: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$products = [];
$result = $conn->query("SELECT product_name FROM product_tb");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row["product_name"];
    }
}

$conn->close();
?>

<form action="" method="post">
    <h1>Delete Product</h1>
    <label for="product_to_delete">Select Product to Delete:</label>
    <select id="product_to_delete" name="product_to_delete">
        <?php
            foreach($products as $product) {
                echo "<option value='$product'>$product</option>";
            }
        ?>
    </select>
    <button type="submit" name="delete_product">Delete Product</button>
</form>

</body>
</html>
