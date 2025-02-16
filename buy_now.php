<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>

<div class="cart-container">
    <h2>Order Summary</h2>

    <?php
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Your cart is empty!</p>";
        echo "<a href='cart.php' class='buy-btn'>Go back to Cart</a>";
        exit();
    }

    if (!isset($_POST['selected_items']) || empty($_POST['selected_items'])) {
        echo "<p>No items selected for purchase.</p>";
        echo "<a href='cart.php' class='buy-btn'>Go back to Cart</a>";
        exit();
    }

    $selected_items = $_POST['selected_items'];

    echo "<ul>";

    foreach ($_SESSION['cart'] as $key => $item) {
        if (in_array($item['id'], $selected_items)) {
            echo "<li>{$item['name']} - ₹{$item['price']} x {$item['quantity']}</li>";
            unset($_SESSION['cart'][$key]); // Remove bought items from cart
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index cart

    echo "</ul>";
    echo "<p>Thank you for your purchase! Your order has been placed.</p>";
    echo "<a href='home.php' class='buy-btn'>Go back to Home</a>";
    ?>
</div>
</body>
</html>
