<?php  
require_once('includes/conn.php');  

// $categoryName='';
// $msg= '';
// $error= '';

// $current_user_id = $_SESSION['user_id'];
// $server_host = $_SERVER['HTTP_HOST'];
// ?>

<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $productName = $_POST['product_name'];
//     $categoryName = $_POST['category_name'];
//     $productPrice = $_POST['product_price'];
//     $stockQuantity = $_POST['stock_quantity'];
//     $productDescription = $_POST['product_description'];
//     $productImage = $_POST['product_image'];
//     $timestamp = $_POST['timestamp'];


//     // Handle the product image upload (move to a folder, rename, etc.)
//     if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
//         $targetDir = 'uploads/product_image';
//         $targetFile = $targetDir . basename($_FILES['product_image']['name']);
//         if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
//             // Image uploaded successfully, continue with database insertion
//             // You can save the $targetFile path in your database for later retrieval
//         } else {
//             // Handle image upload error
//         }
//     }

//     // Perform database insertion for the product details (e.g., product name, description, price, and image path)

//     // Redirect to a success page or handle errors accordingly
// }
?>


<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $categoryName = $_POST['category_name'];
// }

// if ( 
//     $sql = "INSERT INTO category_tb (category_name) VALUES (?)";
//     $stmt = mysqli_prepare($my_conn, $sql);
//     mysqli_stmt_bind_param($stmt, "s", $categoryName);
//     mysqli_stmt_execute($stmt);
//     $n_row2 = mysqli_stmt_affected_rows($stmt);
//     if ($n_row2 > 0) {
//         $msg .= 'Category Name saved successfully';
//     } else {
//         $error .= 'Something went wrong, please try again!';
    
// } 
// )
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin_board.css">
    <!-- <link rel="stylesheet" href="../dist/css/bootstrap.min.css"> -->
</head>
<body>

<?php require_once('nav.php');?>  

    <div class="admin-container">
        <h1>Admin Page - Add Product</h1>
        <div id="error-msg" class="error-message"></div>
        <form id="product-form">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price:</label>
                <input type="number" id="product_price" name="product_price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="product_price">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="product_description">Product Description:</label>
                <textarea id="product_description" name="product_description" required></textarea>
            </div>

            <div class="form-group">
                <label for="product_image">Product Image:</label>
                <input type="file" id="product_image" name="product_image" accept="image/*" required>
            </div>
            <button type="submit">Add Product</button>
        </form>
    </div>
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="admin-container">
        <h1>Admin Page - Add Category</h1>
        <div id="error-msg" class="error-message"></div>
        <form id="product-form">
        <div class="form-group">
                <label for="product_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required>
        </div>
        <button type="submit">Add Category</button>
        </form>
    </div>
</body>
</html>
   

    <!-- <script src="admin_board.js"></script> -->
    <!-- <script src="../dist/js/bootstrap.bundle.js"></script> -->


</body>
</html>
