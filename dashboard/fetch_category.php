<?php
// Step 1: Establish a database connection (Replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$database = "commerce_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>


<style>
    /* *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        width: 100%;
    } */

/* Style for the category container */
.category-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Style for individual categories */
.category {
    padding: 10px;
    margin: 10px 0;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Style for category names */
.category-name {
    font-size: 18px;
    font-weight: bold;
}

/* Optional: Add hover effect for categories */
.category:hover {
    background-color: #f0f0f0;
}
.cat {
  padding-left: 10px;
}


</style>

<body>


<main class="p-0 m-0 row">

            <div class="cat col-2 d-inline-block">
            <h1>Categories</h1>

                <?php // Step 2: Fetch Categories
            $sql = "SELECT * FROM category_tb";
            $result = $conn->query($sql);

            // Step 3: Display Categories
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<p>{$row['category_name']}</p>";
                } 
            } else {
                echo "No categories found.";
            }

            // Step 4: Close the database connection
            $conn->close(); ?>
            </div>