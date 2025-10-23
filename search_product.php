<!-- connect file -->
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
    <title>Ecommers website  </title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">


</head>
<body>
    <!-- navbar -->
    <div class="container-fluid">
        <!-- first class -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <img src="LOGO1.png" alt="" class="logo">
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
        <li class="nav-item">
          <a class="nav-link active" href="user_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Total Price:100/-</a>
        </li>
      </ul>
      <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product">
      </form>
    </div>
  </div>
</nav>
<!-- calling cart function  -->
<?php
cart();
?>

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<?php
if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
    <a class='nav-link' href='#'>Welcome Guest</a>
  </li>";
  }else{
    echo "<li class='nav_item'>
    <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
    </li>";
  }
if(!isset ($_SESSION['username'])){
  echo"<li><a class = 'nav-item'>
  <a class='nav-link' href='./user_area/user_login.php'>Login</a>
  </li>";
}else{
  echo"<li><a class = 'nav-item'>
  <a class='nav-link' href='./user_area/logout.php'>Logout</a>
  </li>";
}
?>
</ul>
</nav>
<!-- third child -->
<div class="bi-light">
<h3 class="text-center">Hidden store </h3>
<p class="text-center">Communication is at the heart of e-commerce and community </p>
</div>



<!-- fouth child -->

<div class ="row">
   <div class="col-md-10">
   <!-- Product -->
    <div class="row">
      <?php
      //calling function
      search_product();
      get_unique_categories();
      get_unique_brand();
    ?>

   </div>
   </div>
   <div class="col-md-2 bg-secondary p-0">
    <!-- brand to be displayed-->
    <ul class="navbar-nav me-auto text-center"> 
      <li class="nav-item bg-info">
        <a href="#" class="nav-link text-light "><h4>Delivery Brands</h4></a>
      </li>
      <?php 
     getbrands();
      ?>
    </ul>
    <!-- catagories to be displayed -->
    <ul class="navbar-nav me-auto text-center"> 
      <li class="nav-item bg-info">
        <a href="#" class="nav-link text-light "><h4>Catagories</h4></a>
      </li>
      <?php 
   getcategories();
      ?> 
    </ul>
</div>
</div>



<!-- last child -->
<div class="bg-info p-3 text-center">
    <p>All rights reserved © Designed by G.Pranay</p>
</div>

    </div>
    <!-- bootst js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>