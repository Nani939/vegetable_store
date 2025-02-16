<?php
include 'db.php';

// Delete item logic
if (isset($_GET['delete']) && isset($_GET['category'])) {
    $id = $_GET['delete'];
    $category = $_GET['category'];

    if ($category == "vegetable") {
        $sql = "DELETE FROM vegetables WHERE id = $id";
    } elseif ($category == "fruit") {
        $sql = "DELETE FROM fruits WHERE id = $id";
    } else {
        $sql = "DELETE FROM pulses WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item deleted successfully!'); window.location='edit.php';</script>";
    } else {
        echo "Error deleting item: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Manage Items</title>
    <link rel="stylesheet" href="edit.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }
        .card img {
            width: 100%;
            height: 150px;
        }
    </style>
</head>
<body>
    <h2>Manage Vegetables</h2>
    <div class="container">
        <?php
        $sql = "SELECT * FROM vegetables";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>
                        <img src='{$row['image']}' alt='{$row['name']}'>
                        <h3>{$row['name']}</h3>
                        <p>₹{$row['price']}/kg</p>
                        <a href='edit_item.php?id={$row['id']}&category=vegetable'>Edit</a> |
                        <a href='edit.php?delete={$row['id']}&category=vegetable'>Delete</a>
                      </div>";
            }
        } else {
            echo "No vegetables available.";
        }
        ?>
    </div>

    <h2>Manage Fruits</h2>
    <div class="container">
        <?php
        $sql = "SELECT * FROM fruits";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>
                        <img src='{$row['image']}' alt='{$row['name']}'>
                        <h3>{$row['name']}</h3>
                        <p>₹{$row['price']}/kg</p>
                        <a href='edit_item.php?id={$row['id']}&category=fruit'>Edit</a> |
                        <a href='edit.php?delete={$row['id']}&category=fruit'>Delete</a>
                      </div>";
            }
        } else {
            echo "No fruits available.";
        }
        ?>
    </div>

    <h2>Manage Pulses & Grains</h2>
    <div class="container">
        <?php
        $sql = "SELECT * FROM pulses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>
                        <img src='{$row['image']}' alt='{$row['name']}'>
                        <h3>{$row['name']}</h3>
                        <p>₹{$row['price']}/kg</p>
                        <a href='edit_item.php?id={$row['id']}&category=pulse'>Edit</a> |
                        <a href='edit.php?delete={$row['id']}&category=pulse'>Delete</a>
                      </div>";
            }
        } else {
            echo "No pulses or grains available.";
        }
        ?>
    </div>

    <br><br>
    <a href="admin.php">Go to Admin Panel</a>

</body>
</html>

