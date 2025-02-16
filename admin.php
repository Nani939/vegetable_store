<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category']; // 'vegetable', 'fruit', or 'pulse'

    // Image Upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert into the selected table
    if ($category == "vegetable") {
        $sql = "INSERT INTO vegetables (name, price, image) VALUES ('$name', '$price', '$target_file')";
    } elseif ($category == "fruit") {
        $sql = "INSERT INTO fruits (name, price, image) VALUES ('$name', '$price', '$target_file')";
    } else {
        $sql = "INSERT INTO pulses (name, price, image) VALUES ('$name', '$price', '$target_file')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Add Products</title>
    <link rel="stylesheet" href="admin.css"> <!-- Link to External CSS -->
</head>
<body>

<div class="theme-toggle">
    <button id="themeButton">🌙 Switch Theme</button>
</div>

<div class="admin-container">
    <h2>Add Vegetables, Fruits, or Pulses/Grains</h2>

    <form method="post" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" required>

        <label>Category:</label>
        <select name="category" required>
            <option value="vegetable">Vegetable</option>
            <option value="fruit">Fruit</option>
            <option value="pulse">Pulse/Grain</option>
        </select>

        <label>Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" class="add-btn">Add Product</button>
    </form>

    <a href="edit.php" class="manage-btn">Manage Items</a>
</div>

<script>
    // Theme Toggle Logic
    const themeButton = document.getElementById('themeButton');
    const body = document.body;

    // Check local storage for theme preference
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        themeButton.innerHTML = "☀️ Switch to Light Mode";
    }

    themeButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            themeButton.innerHTML = "☀️ Switch to Light Mode";
        } else {
            localStorage.setItem('theme', 'light');
            themeButton.innerHTML = "🌙 Switch to Dark Mode";
        }
    });
</script>

</body>
</html>
