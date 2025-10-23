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
<link rel="icon" type="image/x-icon" href="LOGO1.png">
<!-- Bootstrap CSS link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Font Awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Custom CSS file -->
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" href="style2.css">
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
                    <li class="nav-item dropdown">
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
                        <li class="nav-item ">
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
        <div class="Advertising">
            <img src="./admin_area/product_images/image1.jpg" alt="Product Image 1">
            <!-- <img src="./admin_area/product_images/image2.jpg" alt="Product Image 2"> -->
        </div>
    </div>
</div>

        <!-- Store Info -->
        <div class="bg-light py-3 text-center">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>
      <!--grid-->
<div class="container">
        <div class="header">Pick up where you left off</div>
        <div class="grid">
            <div class="card">
                <img src="./images/CAMERA.jpg" alt="Product 1">
                <div class="card-title"> CANON CAMERA</div>
                
            </div>
            <div class="card">
                <img src="./images/LAPTOP2.jpg" alt="Product 3">
                <div class="card-title">HP Pavilion</div>
                
            </div>
            <div class="card">
                <img src="./images/TV3.jpg" alt="Product 4">
                <div class="card-title">Samsung 80 cm</div>
                
            </div>

            <div class="card">
                <img src="./images/phone2.png" alt="Product 2">
                <div class="card-title">Samsung Galaxy S24</div>
                
            </div>
            
            <!-- end -->

                  <!--grid-->
<div class="container">
        <div class="header">Pick up where you left off</div>
        <div class="grid">
            <div class="card">
                <img src="./images/CAMERA.jpg" alt="Product 1">
                <div class="card-title"> CANON CAMERA</div>
                
            </div>
            <div class="card">
                <img src="./images/phone2.png" alt="Product 2">
                <div class="card-title">Samsung Galaxy S24</div>
                
            </div>
            <div class="card">
                <img src="./images/LAPTOP2.jpg" alt="Product 3">
                <div class="card-title">HP Pavilion</div>
            
            </div>
            <div class="card">
                <img src="./images/TV3.jpg" alt="Product 4">
                <div class="card-title">Samsung 80 cm</div>
                
            </div>
            <div class="card">
                <img src="./images/CAMERA.jpg" alt="Product 1">
                <div class="card-title"> CANON CAMERA</div>
                
            </div>
            <div class="card">
                <img src="./images/phone2.png" alt="Product 2">
                <div class="card-title">Samsung Galaxy S24</div>
                </div>
            </div>
            
            <!-- end -->
             <!--grid-->
<div class="container1">
        <div class="header">Pick up where you left off</div>
        <div class="box">
            <div class="card">
                <img src="./images/CAMERA.jpg" alt="Product 1">
                <div class="card-title"> CANON CAMERA</div>
                <div class="card-price">₹35000.00</div>
            </div>
            <div class="card">
                <img src="./images/phone2.png" alt="Product 2">
                <div class="card-title">Samsung Galaxy S24</div>
                <div class="card-price">₹129999.00</div>
            </div>
            <div class="card">
                <img src="./images/LAPTOP2.jpg" alt="Product 3">
                <div class="card-title">HP Pavilion</div>
                <div class="card-price">₹68990.00</div>
            </div>
            <div class="card">
                <img src="./images/TV3.jpg" alt="Product 4">
                <div class="card-title">Samsung 80 cm</div>
                <div class="card-price">₹2999.00</div>
            </div>
        
        <a href="#" class="see-more">See more</a> 
        
    </div>
    </div>
    
            <!-- Integrated new item viewer -->
            <div class="new-item-container">
                <div class="new-arrow left" onclick="scrollItems(-1)">&#10094;</div>
                <div class="new-arrow right" onclick="scrollItems(1)">&#10095;</div>

                <div class="new-item-slider" id="newItemSlider">
                    <div class="new-item-card">
                        <a href="https://www.example.com">
                        <img src="./images/CAMERA.jpg" alt="TV 3">
                        </a>
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/CAMERA2.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/CAMERA3.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/CAMERA4.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/LAPTOP.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/LAPTOP1.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/LAPTOP2.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/LAPTOP3.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/phone1.png" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/phone2.png" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/phone3.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/TV.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/TV1.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/TV2.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <div class="new-item-card">
                        <img src="./images/TV3.jpg" alt="Laptop 2">
                        <div class="new-item-card-content">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                    <!-- Repeat for other items -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include("./includes/footer.php"); ?>
</div>

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-ZMtCUxE7HqYBLxzy2qQy0GYL+I1E6s4t0YfaKHTPBpEU74MFP0XJIVqm9V2zSwEx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9Hcq8YV7QzC5QSlQqynfvlTfjJg60E3gqImR1iBuCf6ll+WMO7pJgUn" crossorigin="anonymous"></script>
<script>
    let itemIndex = 0;
    const items = document.querySelectorAll('.new-item-card');

    function scrollItems(direction) {
        itemIndex += direction;
        if (itemIndex < 0) {
            itemIndex = items.length - 1;
        }
        if (itemIndex >= items.length) {
            itemIndex = 0;
        }
        const newItemSlider = document.getElementById('newItemSlider');
        const itemWidth = items[0].offsetWidth;
        newItemSlider.scrollLeft = itemIndex * itemWidth;
    }
</script>
</body>
</html>
