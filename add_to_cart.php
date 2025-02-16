<?php
session_start();

// Check if cart session exists, if not, create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if grains_id, name, price, and image are received
if (isset($_POST['grains_id'], $_POST['name'], $_POST['price'], $_POST['image'])) {
    $product = [
        'id' => $_POST['grains_id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'], // Store image path
        'quantity' => 1
    ];

    // Check if product already exists in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $_POST['grains_id']) {
            $item['quantity'] += 1; // Increase quantity if already in cart
            $found = true;
            break;
        }
    }

    // If not found, add as a new item
    if (!$found) {
        $_SESSION['cart'][] = $product;
    }

    echo "Product added to cart!";
} else {
    echo "Error: Invalid product data!";
}
?>
