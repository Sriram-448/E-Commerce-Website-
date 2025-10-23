
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_image {
            width: 80px;
            height: 80px;
        }
        body {
            background-color: #f2f2f2; /* Ash color */
        }
    </style>
    <script>
        function increaseQuantity(productId) {
            var quantityInput = document.getElementById('quantity-' + productId);
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity(productId) {
            var quantityInput = document.getElementById('quantity-' + productId);
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>
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
                            <a class="nav-link active" href="display_all.php">Products</a>
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
                            <a class="nav-link active" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Total Price: <?php total_cart_price(); ?></a>
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
                    <?php if (!isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome Guest</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome <?php echo $_SESSION['username']; ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/user_login.php">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Store Info -->
        <div class="bg-light py-3 text-center">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

    <!-- Cart Table -->
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">
                    <!-- PHP code for displaying dynamic data -->
                     
                    <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $total_price = 0;
                        $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "
                            <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row["product_id"];
                                $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                                $result_products = mysqli_query($con, $select_products);
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $product_values = array_sum($product_price);
                                    $product_quantity = $row['quantity'];
                                    $total_price += $product_values * $product_quantity;
                    ?>
                    <tr>
                        <td><?php echo $product_title; ?></td>
                        <td><img src="./admin_area/product_images/<?php echo $product_image1; ?>" alt="" class="cart_image"></td>
                        <td>
                            <button type="button" onclick="decreaseQuantity(<?php echo $product_id; ?>)">-</button>
                            <input type="number" id="quantity-<?php echo $product_id; ?>" name="qty[<?php echo $product_id; ?>]" class="form-input w-25" value="<?php echo $product_quantity; ?>" min="1">
                            <button type="button" onclick="increaseQuantity(<?php echo $product_id; ?>)">+</button>
                        </td>
                        <td><?php echo $price_table; ?>/-</td>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                        <td>
                            <input type="submit" value="UPDATE CART" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                            <input type="submit" value="REMOVE CART" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                        </td>
                    </tr>
                    <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>CART IS EMPTY</h2>";
                        }
                    ?>  
                    </tbody>
                </table>
                <!-- Subtotal -->
                <div class="d-flex mb-5">
                    <?php 
                        $get_ip_add = getIPAddress();
                        $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal: <strong class='text-info'> $total_price/-</strong></h4>
                            <input type='submit' value='CONTINUE SHOPPING' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                            <button class='bg-info px-3 py-2 border-0'><a href='./user_area/checkout.php' class='text-decoration-none'>Checkout</a></button>";
                        } else {
                            echo "<input type='submit' value='CONTINUE SHOPPING' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php', '_self')</script>";
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Function to update cart -->
    <?php
    function update_cart_item() {
        global $con;
        if (isset($_POST['update_cart'])) {
            foreach ($_POST['qty'] as $product_id => $quantity) {
                $get_ip_add = getIPAddress();
                $update_cart = "UPDATE cart_details SET quantity=$quantity WHERE ip_address='$get_ip_add' AND product_id=$product_id";
                $result = mysqli_query($con, $update_cart);
            }
            echo "<script>window.open('cart.php', '_self')</script>";
        }
    }
    echo $update_cart_item = update_cart_item();
    ?>

    <!-- Function to remove items -->
    <?php 
        function remove_cart_item() {
            global $con;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php', '_self')</script>";
                    }
                }
            }
        }
        echo $remove_item = remove_cart_item();
    ?>

    <!-- Footer -->
    <?php include("./includes/footer.php"); ?>
</body>
</html>
