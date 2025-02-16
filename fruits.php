<?php
session_start();
include 'db.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if user is logged in
function isUserLoggedIn(): bool {
    return isset($_SESSION['user_id']); // Adjust this based on your authentication logic
}

// Handle "Buy" button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    if (isUserLoggedIn()) {
        // Process the purchase
        $fruitsId = $_POST['fruits_id'];
        // Add your purchase logic here (e.g., add to cart, process payment)
        echo "Processing purchase for fruits ID: $fruitsId";
    } else {
        // Redirect to login page
        header("Location: login_user.php");
        exit();
    }
}

$sql = "SELECT * FROM fruits";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetable Store</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="index.css">
    
    
</head>
<body>
<header>
    <nav>
        <div class="logo">AGRICONNECT</div>
        <button class="menu-toggle" aria-label="Open Menu" onclick="toggleMenu()">☰</button>
        <ul class="nav-links" id="sidebar">
            <button class="close-menu" aria-label="Close Menu" onclick="toggleMenu()">✖</button>
            <li><a href="home.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="login_user.php" class="login-btn">User Login</a></li>
            <li><a href="login.php" class="login-btn">Admin Login</a></li>
        </ul>
        <div class="user-info">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <?php endif; ?>
        </div>
    </nav>
    <div class="cart-container">
    <a href="cart.php" class="cart-button">🛒 Cart</a>
    </div>
</header>

<script>
    function toggleMenu() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("show");
    }
</script>
    <h2>Available Fruits</h2>
    <div class="fruits-container">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Sanitize data before outputting
                $name = htmlspecialchars($row['name']);
                $price = htmlspecialchars($row['price']);
                $image = htmlspecialchars($row['image']);
                $id = htmlspecialchars($row['id']);
                echo "<div class='fruits-card'>
                        <img src='$image' alt='$name'>
                        <div class='details'>
                            <h3>$name</h3>
                            <p>Price: ₹$price per kg</p>
                          <form method=\"POST\" action=\"add_to_cart.php\">
    <input type=\"hidden\" name=\"grains_id\" value=\"$id\">
    <input type=\"hidden\" name=\"name\" value=\"$name\">
    <input type=\"hidden\" name=\"price\" value=\"$price\">
    <input type=\"hidden\" name=\"image\" value=\"$image\"> <!-- Send image path -->
    <button type=\"submit\" class=\"cart-btn\">Add to Cart</button>
</form>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>No fruits available.</p>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".cart-btn").click(function (e) {
            e.preventDefault();
            var form = $(this).closest("form"); // Get the nearest form
            var formData = form.serialize(); // Serialize the form data

            $.ajax({
                url: "add_to_cart.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert(response); // Show response message
                },
                error: function () {
                    alert("Error adding item to cart!");
                }
            });
        });
    });
</script>
    <style>
/* 🌟 General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f6f6;
    color: #333;
    text-align: center;

}

/* 🌟 Header */
header {
    background: #fff;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #ddd;
        position: fixed;
        width: 100%; /* Adjust width to screen size */
        top: 0px;
        z-index: 1000;
}
h2 {
    text-align: center;
    color: #333;
    margin-top: 100px;
}

/* 🌟 Logo */
.logo {
    font-size: 24px;
    font-weight: bold;
    color: black;
}

/* 🌟 Navigation Menu */
.nav-links {
    list-style: none;
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0;
    left: -100%;
    width: 250px;
    height: 100%;
    background: #fff;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
    transition: left 0.3s ease-in-out;
}

.nav-links.active {
    left: 0;
}

.nav-links li {
    margin: 10px 0;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

.nav-links {
        position: fixed;
        top: 0;
        right: -250px; /* Initially hidden */
        width: 250px;
        height: 100vh;
        background: rgba(0, 0, 0, 0.9); /* Adjusted to a slightly transparent black */
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding-top: 50px;
        transition: right 0.3s ease-in-out;
    }
    
    .nav-links.show {
        right: 0;
    }
    
    .nav-links a {
        color: white;
        text-decoration: none;
        padding: 10px;
        display: block;
    }
    
    .close-menu {
        background: red;
        color: white;
        border: none;
        font-size: 18px;
        padding: 10px;
        cursor: pointer;
        align-self: flex-end;
        margin-right: 10px;
        margin-top: 10px;
    }

/* 🌟 Cart Container */
.cart-container {
        display: flex;
        align-items: center;
        position: relative;
        right: 50px;
        top: 20px;
    }

    .cart-button {
        background: #000;
        color: #fff;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none;
    }
    .user-info {
        position: absolute;
        top: 20px;
        right: 50px;
        color: black;
        font-size: 16px;
        background: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

/* 🌟 Container */
.fruits-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    margin-top: 80px;
}

/* Card */
.fruits-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    padding: 15px;
    text-align: center;
    transition: transform 0.3s;
}

.fruits-card:hover {
    transform: scale(1.05);
}

/* 🌟 Vegetable Image */
.fruits-card img {
    width: 100%;
    height: 180px;
    border-radius: 10px;
    object-fit: cover;
}

/* 🌟 Details Section */
.details {
    padding: 10px;
}

.details h3 {
    margin: 10px 0;
    color: #2c3e50;
}

.details p {
    color: #e67e22;
    font-size: 18px;
    font-weight: bold;
}

/* 🌟 Buy Button */
.cart-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background-color: #28a745;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.cart-btn:hover {
    background-color: #218838;
}

/* 📌 Responsive Design for Tablets */
@media (max-width: 1024px) {
    .vegetable-container {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .cart-container {
        right: 10px;
    }

    .user-info {
        right: 20px;
    }
}

/* 📌 Responsive Design for Mobile */
@media (max-width: 768px) {
    .vegetable-container {
        grid-template-columns: 1fr;
    }

    .vegetable-card {
        width: 90%;
        margin: auto;
    }

    .cart-container {
        position: static;
        text-align: center;
        margin-top: 10px;
    }

    .cart-button {
        width: 100%;
        text-align: center;
    }

    .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 24px;
        padding: 10px;
        background: none;
        border: none;
        text-align: right;
    }

    .nav-links {
        right: -100%;
    }

    .nav-links.show {
        right: 0;
    }
}

    </style>
</body>
</html>
