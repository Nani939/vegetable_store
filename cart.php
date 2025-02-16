<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>

<div class="cart-container">
    <h2>Your Cart</h2>

    <?php
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Your cart is empty!</p>";
    } else {
        echo "<form method='POST' action='buy_now.php'>";
        echo "<table>";
        echo "<tr><th>Select</th><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Actions</th></tr>";

        foreach ($_SESSION['cart'] as $key => $item) {
            echo "<tr>
                    <td><input type='checkbox' name='selected_items[]' value='{$item['id']}'></td>
                    <td><img src='{$item['image']}' alt='{$item['name']}'></td>
                    <td>{$item['name']}</td>
                    <td>₹{$item['price']}</td>
                    <td>{$item['quantity']}</td>
                    <td>
                        <form method='POST' action='remove_from_cart.php'>
                            <input type='hidden' name='item_id' value='{$item['id']}'>
                            <button type='submit' class='remove-btn'>Remove</button>
                        </form>
                    </td>
                  </tr>";
        }

        echo "</table>";
        echo "<button type='submit' class='buy-btn'>Buy Selected Items</button>";
        echo "</form>";
    }
    ?>
</div>
</body>
</html>
