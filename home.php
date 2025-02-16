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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Buy Quality Agricultural Products in Hyderabad | Agriconnect</title>
    <meta name="description" content="Connect with farmers and buy fresh produce directly. Explore secure payments and delivery tracking on Agriconnect.">
    <script src="script.js" defer></script> <!-- Link to external JS -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<header>
    <nav>
        <div class="logo">AGRICONNECT</div>
        <button class="menu-toggle" aria-label="Open Menu" onclick="toggleMenu()">☰</button>
        <ul class="nav-links" id="sidebar">
            <button class="close-menu" aria-label="Close Menu" onclick="toggleMenu()">✖</button>
            <li><a href="#">Home</a></li>
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
<style>
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

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: black;
    }

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

    .cart-container {
        display: flex;
        align-items: center;
        position: relative;
        right: 20px;
        top: 20px;
    }

    .cart-button {
        background: #000;
        color: #fff;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
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

    @media (min-width: 768px) {
        .nav-links {
            flex-direction: column;
            align-items: flex-start;
            padding-left: 20px;
        }
    }
</style>

<script>
    function toggleMenu() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("show");
    }
</script>

<section class="hero">
    <h2>Fresh from the Farm</h2>
    <p>Connect with farmers and buy fresh produce directly with secure payments and delivery tracking.</p>
    <a href="#" class="btn">Shop Now</a>
</section>

<section class="products">
    <h2>Our Products</h2>
    <div class="product-list">
        <div class="product">
            <a href="vegetables.php" class="button">
                <img src="https://th.bing.com/th/id/OIP.rlOfN24ZxkhxivUQdhDdUgHaF_?rs=1&pid=ImgDetMain" alt="Fresh Vegetables">
            </a>
            <h3>Fresh Vegetables</h3>
            <p>Organic and locally sourced vegetables.</p>
        </div>
        <div class="product">
            <a href="fruits.php" class="button">
                <img src="https://images.creativemarket.com/0.1.0/ps/4007769/910/607/m2/fpnw/wm1/ojjyl9nu0s2mcx3lzmi12p4yjrnf99xolh7su8qfzxujcgfxdoh5k7erxujvnuj1-.jpg?1518655059&s=8ac9fe9551f0b13656c139dde341046d" alt="Farm Fruits">
            </a>
            <h3>Farm Fruits</h3>
            <p>Seasonal and exotic farm-fresh fruits.</p>
        </div>
        <div class="product">
            <a href="grains.php" class="button">
                <img src="https://images.squarespace-cdn.com/content/v1/5cb6f2342727be1aba777197/1656325859653-8RFJZCTI8XJ1G16O6FVI/Pulses+%26+Grains.jpeg" alt="Grains & Pulses">
            </a>
            <h3>Grains & Pulses</h3>
            <p>High-quality grains and pulses direct from farmers.</p>
        </div>
    </div>
</section>

<div class="form-container">
    <h2>Get in touch...<br> We're here to assist you!</h2>
    <form id="contactForm">
        <label for="name">Name <span class="required">*</span></label>
        <input type="text" id="name" name="name" required placeholder="Jane Smith">

        <label for="email">Email address <span class="required">*</span></label>
        <input type="email" id="email" name="email" required placeholder="email@website.com">

        <label for="phone">Phone number <span class="required">*</span></label>
        <input type="tel" id="phone" name="phone" required placeholder="555-555-5555">

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="4"></textarea>

        <div class="checkbox-container">
            <input type="checkbox" id="consent" name="consent" required>
            <label for="consent">I allow this website to store my submission so they can respond to my inquiry. <span class="required">*</span></label>
        </div>

        <button type="submit" class="submit-btn">SUBMIT</button>
    </form>
    <p id="successMessage" style="display: none; color: green; font-weight: bold;">Form submitted successfully!</p>
</div>
<style>
    .form-container {
        font-family: 'Poppins', sans-serif;
        background:  #f1eded;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        flex-direction: column;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;

    }
    .hero h2 {
        font-size: 48px; /* Increase the text size */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add shadow effect to text */
    text-align: center;
    color: white;
    margin-top: 200px;
}


    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .required {
        color: red;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        resize: vertical;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .checkbox-container input {
        margin-right: 10px;
    }

    .submit-btn {
        background-color: #28a745;
        color: white;
        padding: 12px;
        border: none;
        width: 100%;
        border-radius: 4px;
        font-weight: bold;
        margin-top: 15px;
        cursor: pointer;
    }

    .submit-btn:hover {
        background-color: #218838;
    }
</style>

<script>
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent actual form submission

        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let phone = document.getElementById("phone").value.trim();
        let consent = document.getElementById("consent").checked;
        let successMessage = document.getElementById("successMessage");

        if (name === "" || email === "" || phone === "" || !consent) {
            alert("Please fill out all required fields.");
            return;
        }

        // Show success message
        successMessage.style.display = "block";

        // Reset form after submission
        document.getElementById("contactForm").reset();

        // Hide message after 3 seconds
        setTimeout(() => {
            successMessage.style.display = "none";
        }, 3000);
    });
</script>

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>
        <span class="icon">📧</span>
        <a href="mailto:swamybommakanti00@gmail.com" id="email-link">swamybommakanti00@gmail.com</a>
    </p>

    <h2>Location</h2>
    <p>
        <span class="icon">📍</span>
        <a href="https://www.google.com/maps?q=Hyderabad,TS,IN" target="_blank" id="location-link">Hyderabad, TS IN</a>
    </p>

    <h2>Hours</h2>
    <table>
        <tr><td>Mon</td><td>9:00am – 10:00pm</td></tr>
        <tr><td>Tue</td><td>9:00am – 10:00pm</td></tr>
        <tr><td>Wed</td><td>9:00am – 10:00pm</td></tr>
        <tr><td>Thu</td><td>9:00am – 10:00pm</td></tr>
        <tr><td>Fri</td><td>9:00am – 10:00pm</td></tr>
        <tr><td>Sat</td><td>9:00am – 6:00pm</td></tr>
        <tr><td>Sun</td><td>9:00am – 12:00pm</td></tr>
    </table>
</div>

<script>
    document.getElementById("contact-btn").addEventListener("click", function() {
        let message = document.getElementById("message");
        message.style.display = "block";
        setTimeout(() => {
            message.style.display = "none";
        }, 3000);
    });
</script>

<style>
    .contact-container {
        padding: 20px;
        display: flex;
        border-radius: 8px;
        width: 400px;
        text-align: center;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }

    h2 {
        font-size: 20px;
        margin-bottom: 5px;
    }

    p {
        font-size: 16px;
        margin: 5px 0;
    }

    .icon {
        margin-right: 8px;
    }

    a {
        text-decoration: none;
        color: #000;
        font-weight: bold;
    }

    a:hover {
        color: #007bff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    td {
        padding: 5px 0;
    }
</style>

<footer>
    <p>© 2025 Agriconnect. All rights reserved.</p>
</footer>
</body>
</html>
