<?php
include 'db.php';

if (isset($_GET['id']) && isset($_GET['category'])) {
    $id = $_GET['id'];
    $category = $_GET['category'];

    if ($category == "vegetable") {
        $sql = "SELECT * FROM vegetables WHERE id = $id";
    } elseif ($category == "fruit") {
        $sql = "SELECT * FROM fruits WHERE id = $id";
    } else {
        $sql = "SELECT * FROM pulses WHERE id = $id";
    }

    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    if ($category == "vegetable") {
        $sql = "UPDATE vegetables SET name='$name', price='$price' WHERE id=$id";
    } elseif ($category == "fruit") {
        $sql = "UPDATE fruits SET name='$name', price='$price' WHERE id=$id";
    } else {
        $sql = "UPDATE pulses SET name='$name', price='$price' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item updated successfully!'); window.location='edit.php';</script>";
    } else {
        echo "Error updating item: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h2>Edit Item</h2>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $item['name']; ?>" required><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $item['price']; ?>" required><br>

        <button type="submit">Update Item</button>
    </form>

    <br>
    <a href="edit.php">Back to Manage Items</a>
    <style>
        /* 🌟 General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    transition: background 0.3s ease, color 0.3s ease;
}

/* 🌟 Edit Container */
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

form {
    background: white;
    padding: 25px;
    width: 400px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

/* 🌟 Labels & Inputs */
label {
    font-weight: bold;
    text-align: left;
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

/* 🌟 Update Button */
button {
    background-color: #007bff;
    color: white;
    padding: 12px;
    border: none;
    width: 100%;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* 🌟 Back to Manage Items */
a {
    display: inline-block;
    margin-top: 15px;
    padding: 10px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

a:hover {
    background: #218838;
}

/* 🌙 Dark Mode */
body.dark-mode {
    background: #121212;
    color: white;
}

.dark-mode form {
    background: #1e1e1e;
    color: white;
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
}

.dark-mode input {
    background: #222;
    color: white;
    border: 1px solid #444;
}

.dark-mode button {
    background-color: #0a84ff;
}

.dark-mode button:hover {
    background-color: #007aff;
}

.dark-mode a {
    background: #34c759;
}

.dark-mode a:hover {
    background: #28a745;
}

/* 📌 Responsive Design */
@media (max-width: 768px) {
    form {
        width: 90%;
        padding: 20px;
    }
}

@media (max-width: 480px) {
    form {
        width: 95%;
    }

    input, button, a {
        font-size: 14px;
    }
}


    </style>
</body>
</html>