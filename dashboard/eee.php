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
        <h1 class="text-center">Add Product</h1>
        <form method="post" action="your_action_file.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <!-- Add more categories as needed -->
                </select>
            </div>

            <div class="form-group">
                <label for="product_price">Product Price:</label>
                <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
            </div>

            <div class="form-group">
                <label for="former_price">Former Price:</label>
                <input type="number" step="0.01" class="form-control" id="former_price" name="former_price" required>
            </div>

            <div class="form-group">
                <label for="product_discount">Product Discount:</label>
                <input type="number" step="0.01" class="form-control" id="product_discount" name="product_discount" required>
            </div>

            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
            </div>

            <div class="form-group">
                <label for="product_description">Product Description:</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="product_image">Product Image:</label>
                <input type="file" class="form-control-file" id="product_image" name="product_image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net
