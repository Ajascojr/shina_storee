<?php
// session_start();

require_once('includes/conn.php');   

if(isset($_SESSION['user_id'])) {
    $active_user_id = $_SESSION['user_id'];
} else {
    // Handle case where user is not logged in
    // You might want to redirect them to a login page or handle it in some way.
}

if ( isset( $_POST['remove_cart'] ) ) {
    $cart_id = $_POST['item_id'];
    $dqr = "DELETE from cart_tb WHERE product_id = '$cart_id'";
    $rdq = mysqli_query($my_conn , $dqr);
    $row0 = mysqli_affected_rows($my_conn);
    if ( $row0 > 0 ) {
        $removeSuccessMessage = "Product successfully removed from cart.";
    } else {
        $removeErrorMessage = "Something went wrong while removing the product.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $cart_id = $_POST['item_id'];
    $new_quantity = $_POST['new_quantity'];

    $updateQuery = "UPDATE cart_tb SET quantity = '$new_quantity' WHERE product_id = '$cart_id'";
    mysqli_query($my_conn, $updateQuery);
    $success_message = "Quantity updated successfully.";
}

$qq = "SELECT * FROM cart_tb WHERE user_id = '$active_user_id'";
$rr = mysqli_query($my_conn , $qq);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .quantity-cell {
            display: flex;
            align-items: center;
            gap: 5px; /* Adjust the gap as needed */
        }

        .small-input {
            width: 50px; /* Adjust the width as needed */
        }

        /* Remove underline and set text color for product names */
        .product-name a {
            text-decoration: none;
            color: black;
        }

        .product-image {
            max-width: 50px; /* Set the maximum width for the product image */
            max-height: 50px; /* Set the maximum height for the product image */
        }

        .remove-button {
            width: 50px; /* Set the width for the remove button */
            height: 50px; /* Set the height for the remove button */
        }
    </style>
</head>
<body>
    <?php require_once('nav.php'); ?>

    <?php
    if(isset($removeSuccessMessage)) {
        echo "<div class='alert alert-success'>$removeSuccessMessage</div>";
    }

    if(isset($removeErrorMessage)) {
        echo "<div class='alert alert-danger'>$removeErrorMessage</div>";
    }
    ?>

    <div class="container mt-5">
        <form method="post" id="cartForm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($rr) > 0) {
                        while ($result = mysqli_fetch_assoc($rr)) {
                            $qty = $result['quantity'];
                            $dd = $result['product_id'];
                            $sq = "SELECT * FROM product_tb WHERE id = '$dd'";
                            $sq = mysqli_query($my_conn , $sq);
                            while ($rs = mysqli_fetch_assoc($sq)) {
                                $total += $rs['product_price'];
                                echo " <tr>
                                <td>
                                <div class='d-flex align-items-center product-name'>
                                    <a href='product_details.php?id={$rs['id']}'>
                                        <img src='{$rs['product_image']}' alt='{$rs['product_name']}' class='product-image'>
                                        {$rs['product_name']}
                                    </a>
                                </div>
                            </td>
                                    <td>&#x20A6;" . number_format($rs['product_price'], 2) . "</td>
                                    <td class='quantity-cell'> 
                                        <button type='button' class='btn btn-secondary' data-action='minus' onclick='updateQuantity(\"minus\", {$rs['id']})'>-</button>
                                        <input type='number' name='quantity' class='form-control small-input' id='quantity_{$rs['id']}' 
                                            data-price='{$rs['product_price']}' value='$qty' 
                                            onchange='updateProductTotal({$rs['product_price']}, this.value, {$rs['id']})'>
                                        <button type='button' class='btn btn-secondary' data-action='plus' onclick='updateQuantity(\"plus\", {$rs['id']})'>+</button>
                                        <div id='success_message_{$rs['id']}' class='text-success'></div>
                                    </td>
                                    <td><span id='productTotal_{$rs['id']}' class='productTotal'>{$rs['product_price']}</span></td>
                                    <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='item_id' value='{$rs['id']}'>
                                        <button type='submit' name='remove_cart' class='btn btn-danger btn-sm remove-button'><i class='fa-2x fa-solid fa-trash' style='100px'></i> </button>
                                    </form>
                                </td>
                                </tr>";
                            }
                        }
                    } else {
                        echo '<tr><td colspan="5"><h4>Your cart is empty!</h4></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <a href="homepage.php" class="btn btn-secondary">Continue Shopping</a>
                </div>
                <div class="col-md-6 text-right">
                    <h4>Grand Total: &#x20A6;<span id="grandTotal"><?= number_format($total, 2) ?></span></h4>
                    <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateQuantity(action, productId) {
            let quantityElement = document.getElementById(`quantity_${productId}`);
            let currentQuantity = parseInt(quantityElement.value);
            if (action === 'plus') {
                quantityElement.value = currentQuantity + 1;
                document.getElementById(`success_message_${productId}`);
                // document.getElementById(`success_message_${productId}`).innerText = 'Quantity updated successfully!';
            } else if (action === 'minus' && currentQuantity > 1) {
                quantityElement.value = currentQuantity - 1;
                document.getElementById(`success_message_${productId}`);
                // document.getElementById(`success_message_${productId}`).innerText = 'Quantity updated successfully!';
            }
            updateProductTotal(
                parseFloat(quantityElement.dataset.price),
                parseInt(quantityElement.value),
                productId
            );
            updateButtons(productId);
        }

        function updateButtons(productId) {
            let quantityElement = document.getElementById(`quantity_${productId}`);
            let minusButton = document.querySelector(`#quantity_${productId} + button[data-action="minus"]`);
            let plusButton = document.querySelector(`#quantity_${productId} + input + button[data-action="plus"]`);

            let currentQuantity = parseInt(quantityElement.value);

            if (currentQuantity === 1) {
                minusButton.disabled = true;
            } else {
                minusButton.disabled = false;
            }

            if (currentQuantity === 10) {
                plusButton.disabled = true;
            } else {
                plusButton.disabled = false;
            }
        }

        function updateProductTotal(price, quantity, productId) {
            let productTotalElement = document.getElementById(`productTotal_${productId}`);
            let productTotal = price * quantity;
            productTotalElement.innerText = productTotal.toFixed(2);

            // Update the total_price and quantity in the database using AJAX
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update successful
                    updateGrandTotal();
                }
            };
            xhttp.open("GET", `update_total_price.php?product_id=${productId}&total_price=${productTotal}&quantity=${quantity}`, true);
            xhttp.send();
        }

        function updateGrandTotal() {
            let totalElements = document.querySelectorAll('.productTotal');
            let grandTotalElement = document.getElementById('grandTotal');

            let grandTotal = 0;
            totalElements.forEach(element => {
                grandTotal += parseFloat(element.innerText);
            });

            grandTotalElement.innerText = grandTotal.toFixed(2);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
