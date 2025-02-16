# vegetable_store
# 🌾 AgriConnect - Online Grocery Store

AgriConnect is an **online grocery store** where users can browse, add products to the cart, and place orders for agricultural products such as grains, fruits, and vegetables. The platform includes a user authentication system, shopping cart functionality, and an admin panel to manage products.

## 📌 Features

### **User Features**
✔ User registration & login (authentication system)  
✔ Browse different product categories (grains, fruits, vegetables)  
✔ Add products to the cart  
✔ Remove items from the cart  
✔ Select specific items to purchase  
✔ Checkout system to complete purchases  
✔ User-friendly interface with a responsive design  

### **Admin Features**
✔ Secure admin login  
✔ Add new products (name, price, image)  
✔ Edit & update existing products  
✔ Remove products from the store  
✔ Manage user orders  

## 🛠 Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, MySQL
- **Database:** MySQL (for storing users, products, and orders)
- **Styling:** CSS (cart.css, admin.css, styles.css)
- **Scripting:** JavaScript (script.js for interactive UI)

## 📂 Project Structure
```
/AgriConnect
├── add_to_cart.php      # Adds items to the cart
├── admin.php            # Admin dashboard
├── admin.css            # Admin panel styling
├── buy_now.php          # Checkout functionality
├── cart.php             # Shopping cart page
├── cart.css             # Shopping cart styling
├── db.php               # Database connection
├── edit.php             # Edit product details
├── edit_item.php        # Admin product editing
├── edit.css             # Edit page styling
├── fruits.php           # Displays fruits
├── grains.php           # Displays grains
├── home.php             # Homepage
├── login.php            # User login page
├── login_user.php       # Login form handler
├── logout.php           # Logout functionality
├── register.php         # User registration
├── register_user.php    # Handles user registration
├── remove_from_cart.php # Removes items from the cart
├── script.js            # JavaScript for UI functionality
├── styles.css           # Main website styling
├── vegetables.php       # Displays vegetables
```

## 🚀 How to Run the Project
### 1️⃣ **Setup the Database**
1. Open **XAMPP** (or any local server that supports PHP & MySQL).
2. Start **Apache** and **MySQL**.
3. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
4. Create a database named `agriconnect`.
5. Import the provided **SQL file** (if available) to set up tables.

### 2️⃣ **Configure Database Connection**
Modify `db.php` to match your database credentials:
```php
<?php
$servername = "localhost";
$username = "root";  // Change if necessary
$password = "";  // Change if necessary
$dbname = "agriconnect";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 3️⃣ **Run the Project**
1. Place the project files inside the `htdocs` folder (if using XAMPP).
2. Open your browser and go to `http://localhost/AgriConnect/home.php`.
3. Register as a user and start shopping!
4. Admins can log in via `http://localhost/AgriConnect/admin.php`.

## 🎯 Future Enhancements
- Integrate **payment gateways** (Razorpay, PayPal, Stripe, etc.).
- Implement **order history** for users.
- Improve **admin dashboard** with analytics.
- Add **search & filter options** for products.

---
### ✨ **Contributors**
Developed by **Swamy Mudhiraj** 🚀

---

This project is open-source. Feel free to modify and improve it! 🔥

