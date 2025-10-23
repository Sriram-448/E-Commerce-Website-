<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f2f2f2; /* Ash color */
        }
        .container {
            display: flex;
        }
        .side-nav {
            width: 250px;
            background: #f8f8f8;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: fixed;
            height: calc(100vh - 60px); /* Adjust height to fill the remaining viewport height */
            overflow-y: auto;
            top: 225px; /* Adjust top to match the height of the first navbar */
            left: 0;
            z-index: 1000;
        }
        .side-nav a {
            display: block;
            color: #333;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .side-nav a:hover {
            background: #ddd;
        }
        .main-content {
            margin-left: 270px; /* Add some margin to the left to make space for the side nav */
            padding: 20px;
            flex-grow: 1;
        }
        h1, h2 {
            color: #333;
        }
        h3 {
            color: #555;
        }
        p {
            color: #666;
        }
        .faq-section {
            display: none; /* Initially hide all FAQ sections */
            margin-bottom: 20px;
        }
        .faq-section h3 {
            margin-top: 20px;
        }
        .chatbot-container {
            width: 300px;
            position: fixed;
            bottom: 0;
            right: 20px;
            border: 1px solid #ccc;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px 10px 0 0;
        }
        .chatbot-header {
            background: #6c757d;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chatbot-content {
            display: none;
            flex-direction: column;
            height: 400px;
            overflow: hidden;
        }
        .chatbot-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            height: calc(100% - 50px);
        }
        .chatbot-messages div {
            margin: 5px 0;
            padding: 10px;
            border-radius: 10px;
        }
        .user-message {
            background: #1686C0;
            color: white;
            text-align: right;
            align-self: flex-end;
        }
        .bot-message {
            background: #ffffff;
            color: #333;
            text-align: left;
            align-self: flex-start;
        }
        #chatbot-input {
            width: calc(100% - 70px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0 0 0 10px;
        }
        .chatbot-content button {
            width: 60px;
            padding: 10px;
            border: none;
            background: #6c757d;
            color: white;
            border-radius: 0 0 10px 0;
            cursor: pointer;
        }
        .chatbot-content button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <!-- First Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="LOGO1.png" alt="" class="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="display_all.php">Products</a>
                        </li>
                        <?php if(isset($_SESSION['username'])): ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="user_area/profile.php">My Account</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="user_area/user_registration.php">Register</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <sup><?php cart_item(); ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Total Price: <?php total_cart_price(); ?></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" required>
                        <input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- Calling Cart Function -->
        <?php cart(); ?>

        <!-- Second Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <?php if(!isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Welcome Guest</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="user_area/profile.php">Welcome <?php echo $_SESSION['username']; ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-light"  href="./user_area/user_login.php">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./user_area/logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="./admin_area/admin_registration.php">Sell</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Store Info -->
        <div class="bg-light py-3 text-center">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>
    </div>

    <div class="container">
        <div class="side-nav">
            <h2>FAQs</h2>
            <a href="#faq1" onclick="showFaqSection('faq1')">How to place an order?</a>
            <a href="#faq2" onclick="showFaqSection('faq2')">Shipping options and delivery times</a>
            <a href="#faq3" onclick="showFaqSection('faq3')">Return and refund policy</a>
            <a href="#faq4" onclick="showFaqSection('faq4')">How to track my order?</a>
        </div>
        <div class="main-content">
        <h1>Customer Service</h1>
            <p>Welcome to Our Customer Service Page</p>
            <p>At Hidden Store, we are dedicated to providing you with the best shopping experience. Below you will find answers to the most commonly asked questions. If you need further assistance, please don't hesitate to contact our support team.</p>
            <div id="faq1" class="faq-section">
                <h3>How to place an order?</h3>
                <p>To place an order, simply browse our products, add them to your cart, and proceed to checkout...</p>
            </div>
            <div id="faq2" class="faq-section">
                <h3>Shipping options and delivery times</h3>
                <p>We offer standard, expedited, and overnight shipping options. Standard shipping takes 5-7 business days...</p>
            </div>
            <div id="faq3" class="faq-section">
                <h3>Return and refund policy</h3>
                <p>We accept returns within 30 days of purchase. Please ensure the items are in their original condition...</p>
            </div>
            <div id="faq4" class="faq-section">
                <h3>How to track my order?</h3>
                <p>After placing your order, you will receive a confirmation email with a tracking number. Use this number to track your package...</p>
            </div>
            <div class="contact-section">
                <h2>Contact Us</h2>
                <p>If you have any other questions or need further assistance, please contact our customer service team:</p>
                <p><strong>Email:</strong> support@Hiddenstore.com<br>
                <strong>Phone:</strong> 1-800-123-4567<br>
                <strong>Live Chat:</strong> Available on our website from 9 AM to 6 PM (Monday to Friday)</p>
            </div>

            <p>Thank you for shopping with Hidden Store. We look forward to serving you!</p>
        </div>
    </div>

    <!-- Chatbot -->
    <div class="chatbot-container">
        <div class="chatbot-header" onclick="toggleChatbot()">
            <span>Chat with us!</span>
            <span id="chatbot-toggle-icon">+</span>
        </div>
        <div id="chatbot-content" class="chatbot-content">
            <div id="chatbot-messages" class="chatbot-messages"></div>
            <div class="chatbot-input-container">
                <input type="text" id="chatbot-input" onkeypress="handleKeyPress(event)" placeholder="Type your message here...">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>

    <script>
        function toggleChatbot() {
            const content = document.getElementById('chatbot-content');
            const toggleIcon = document.getElementById('chatbot-toggle-icon');
            if (content.style.display === 'none' || content.style.display === '') {
                content.style.display = 'flex';
                toggleIcon.textContent = '-';
            } else {
                content.style.display = 'none';
                toggleIcon.textContent = '+';
            }
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function sendMessage() {
            const input = document.getElementById('chatbot-input');
            const message = input.value.trim();
            if (message === '') return;

            displayMessage(message, 'user-message');
            input.value = '';

            // Bot's response
            const botResponse = getBotResponse(message);
            setTimeout(() => displayMessage(botResponse, 'bot-message'), 500);
        }

        function displayMessage(message, className) {
            const messagesContainer = document.getElementById('chatbot-messages');
            const messageElement = document.createElement('div');
            messageElement.className = className;
            messageElement.innerText = message;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function getBotResponse(message) {
            // Simple bot logic (can be expanded)
            const lowerCaseMessage = message.toLowerCase();
            if (lowerCaseMessage.includes('hello')) {
                return 'Hi there! How can I help you today?';
            } else if (lowerCaseMessage.includes('hi')) {
                return 'Hi there! How can I help you today?';
            } else if (lowerCaseMessage.includes('payment')) {
                return 'we  offer customers various options like PayPal, net banking, and cash on delivery.';
            } else if (lowerCaseMessage.includes('delivery date')) {
                return 'We will ship your products as soon as possible. You will receive an email once your order has been shipped.';
            } else if (lowerCaseMessage.includes('delivery')) {
                return 'We will ship your products as soon as possible. You will receive an email once your order has been shipped.';
            } else if (lowerCaseMessage.includes('address')) {
                return 'Please note that the delivery address cannot be changed once the product has been shipped.';
            } else if (lowerCaseMessage.includes('order')) {
                return 'You can place an order by browsing our products and adding them to your cart.';
            } else if (lowerCaseMessage.includes('shipping')) {
                return 'We offer standard, expedited, and overnight shipping options.';
            } else {
                return 'I\'m not sure how to answer that. Can you please provide more details?';
            }
        }

        // Initialize chatbot content visibility
        toggleChatbot();

        function showFaqSection(faqId) {
            const sections = document.querySelectorAll('.faq-section');
            sections.forEach(section => section.style.display = 'none');

            const selectedSection = document.getElementById(faqId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }
    </script>
</body>
</html>
