<?php
    // Connect to your database here
    $conn = new mysqli("localhost", "root", "", "commerce_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    // Add more fields as per your form

    // Get user_id (assuming you have this information available)
    $user_id = 1; // Replace with actual user ID

    // Get current timestamp
    $timestamp = date('Y-m-d H:i:s');

    // Insert data into the database
    $sql = "INSERT INTO product_tb (product_name, category_id, user_id, timestamp) VALUES ('$product_name', '$category_id', '$user_id', '$timestamp')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Product</h1>
        <form action="process_product.php" method="post">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <select class="form-control" id="category_name" name="category_id" required>
                    <?php
                        // Connect to your database here
                        $conn = new mysqli("localhost", "root", "", "commerce_db");

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $result = $conn->query("SELECT id, category_name FROM category_tb");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
                        }
                        $conn->close();
                    ?>
                </select>
            </div>
            <!-- Add other input fields (product_price, former_price, product_discount, stock_quantity, product_description, product_image) here -->
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

