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

    // Step 3: Upload Product Image (assuming you have an image upload input field)
    $targetDir = "uploads/product_image/"; // Create an 'uploads' directory in your project

    // Generate a unique filename for uploaded image
    $targetFile = $targetDir . basename($_FILES['product_image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES['product_image']['tmp_name']);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo '<div class="alert alert-danger">' . "File is not an image." . '</div>';
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo '<div class="alert alert-danger">' . "Sorry, file already exists." . '</div>';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['product_image']['size'] > 500000) {
        echo '<div class="alert alert-danger">' . "Sorry, your file is too large." . '</div>';
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp") {
        echo '<div class="alert alert-danger">' . "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed." . '</div>';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo '<div class="alert alert-danger">' . "Sorry, your file was not uploaded." . '</div>';
    } else {
        // File uploaded successfully, proceed with database insertion

        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
            $sql = "INSERT INTO product_tb (product_name, product_image)
                    VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $product_name, $targetFile);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success">' . "Product added successfully!" . '</div>';
            } else {
                echo '<div class="alert alert-danger">' . "Error: " . $sql . "<br>" . $conn->error . '</div>';
            }

            $stmt->close();
        } else {
            echo '<div class="alert alert-danger">' . "Error uploading file." . '</div>';
        }
    }
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
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" class="form-control-file" id="product_image" name="product_image" accept="image/*" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
