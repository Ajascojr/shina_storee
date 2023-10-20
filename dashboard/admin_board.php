<?php

// Assuming you have a connection to your database
// $servername = "localhost";
// $username = "root"; // Replace with your database username
// $password = ""; // Replace with your database password
// $dbname = "commerce_db"; // Replace with your database name

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Assuming you have a form where the user inputs the category name
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $category_name = $_POST["category_name"];


//     // Validate input to prevent SQL injection (you should use prepared statements in production)
//     $category_name = mysqli_real_escape_string($conn, $category_name);

//     // Insert the category into the database
//     $sql = "INSERT INTO category_tb (category_name) VALUES ('$category_name')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Category added successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
<body>



    <div class="container">
        <h1>Add Category</h1>
        <form action="" method="post">
            <label for="category_name">Category Name:</label>
            <input type="text" id="category_name" name="category_name" required>
            <input type="submit" value="Add Category">
        </form>
    </div>
</body>
</html>



