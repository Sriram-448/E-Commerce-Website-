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
</head>
<body>
<style>
    body {
        background-color: #f2f2f2; /* Ash color */
    }
</style>

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
                            <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
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
                    <!-- Menu Dropdown -->
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-light" aria-current="page" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><h6 class="dropdown-header text-light">BRANDS</h6></li>
                            <li class="nav-item text-light">
                            <?php getbrands(true, 'text-light'); // Display brands in dropdown with white text ?>
                            <li><hr class="dropdown-divider text-light"></li>
                            <li><h6 class="dropdown-header text-light">CATEGORIES</h6></li>
                            <?php getcategories(true, 'text-light'); // Display categories in dropdown ?>
                        </ul>
                    </li>
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
                            <a class="nav-link text-light" href="./user_area/user_login.php">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./user_area/logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="./admin_area/admin_registration.php">Sell</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Slider -->
        <div class="slider-frame">
            <div class="slide-images">
                <div class="img-container">
                    <img src="./admin_area/product_images/image1.jpg" alt="Product Image 1">
                </div>
                <!-- <div class="img-container">
                    <img src="./admin_area/product_images/image2.png" alt="Product Image 2">
                </div> -->
            </div>
        </div>

        <!-- Store Info -->
        <div class="bg-light py-3 text-center">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <!-- Products and Sidebar -->
        <div class="row px-3">
            <div class="col-md-10">
                <div class="row">
                    <?php
                    // Fetch and display products
                    get_all_products();
                    get_unique_categories();
                    get_unique_brand();
                    ?>
                </div>
            </div>
        <!-- Footer -->
        <?php include("./includes/footer.php"); ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
