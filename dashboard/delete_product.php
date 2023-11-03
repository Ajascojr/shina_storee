<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "commerce_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];

    // Get product image filename from the database
    $stmt = $conn->prepare("SELECT id, product_image FROM product_tb WHERE product_name = ?");
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $stmt->bind_result($product_id, $product_image);
    $stmt->fetch();
    $stmt->close();

    // Delete product from database
    $stmt = $conn->prepare("DELETE FROM product_tb WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        // Product successfully deleted from the database

        // Check if the image file exists in the folder
        if (file_exists($product_image)) {
            // If the image exists, delete it
            unlink($product_image);
        }

        echo '<div class="alert alert-success">' . "Product deleted successfully!" . '</div>';
    } else {
        echo '<div class="alert alert-danger">' . "Error deleting product: " . $conn->error . '</div>';
    }

    $stmt->close();
}

// Fetch list of product names for the dropdown menu
$product_result = $conn->query("SELECT product_name FROM product_tb");

if ($product_result->num_rows > 0) {
    while ($row = $product_result->fetch_assoc()) {
        $products[] = $row["product_name"];
    }
} else {
    $products = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require_once('nav.php'); ?>

    <div class="container mt-5">
        <form method="post">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <select class="form-control" id="product_name" name="product_name" required>
                    <?php
                    foreach($products as $product) {
                        echo "<option value='$product'>$product</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-danger">Delete Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
