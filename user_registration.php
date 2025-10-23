<?php include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-registration</title>
     <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex aline-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6">
    <form action="" method="post" enctype="multipart/form-data">
            <!-- user name field -->
            <div class="form-outline mb-4">
            <label for="user_username" class="form-label">Username</label>
            <input type="text" id="user_username" class="form-control" placeholder="Enter your name" autocomplete="off" requried="required" name="user_username"/>
</div>
<!-- email field -->
<div class="form-outline mb-3">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" id="user_email" class="form-control" placeholder="Enter your Email"  autocomplete="off" requried="required" name="user_userEmail"/>
</div>
<!-- image field -->
<div class="form-outline mb-3">
            <label for="user_image" class="form-label">User image</label>
            <input type="file" id="user_image" class="form-control" requried="required" name="user_image"/>
</div>
<!-- password field -->
<div class="form-outline mb-3">
            <label for="user_password" class="form-label">password</label>
            <input type="password" id="user_password" class="form-control" placeholder="Enter your password"  autocomplete="off" requried="required" name="user_password"/>
</div>
<!-- confirm password field -->
<div class="form-outline mb-3">
            <label for="confirm_user_password" class="form-label">confirm password</label>
            <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm password"autocomplete="off" requried="required" name="confirm_user_password"/>
</div>
            <!-- address field -->
            <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" requried="required" name="user_address"/>
</div>
            <!-- contactfield -->
            <div class="form-outline mb-4">
            <label for="user_contact" class="form-label">contact</label>
            <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" requried="required" name="user_contact"/>
</div>
<div class="text_center">
    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
    <p class="small fw-bold mt-2 pt-1 mb-0">Alerady have an account? <a href="user_login.php" class="text-danger"> Login</a></p>
</div>
</form>
    </div>
    </div>
    </div>
</body>
</html>

<!-- php code -->
<?php 
   if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_userEmail=$_POST['user_userEmail'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $confirm_user_password=$_POST['confirm_user_password'];
    $user_address=$_POST['user_address']; 
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();



    // select query

    $select_query= " select * from  user_table where username='$user_username' or user_email = '$user_userEmail'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo"<script> alert('USERNAME AND EMAIL ALREADY EXIST')</script>";
        }else if($user_password!= $confirm_user_password){
            echo"<script> alert('password do not match')</script>";
        }
else{


        //insert_query
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $insert_query="insert into user_table (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values('$user_username','$user_userEmail','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
        $sql_execute=mysqli_query($con,$insert_query);
        if($sql_execute){
            echo"<script> alert('Data inserted sucessfully')</script>";
        }else{
            die(mysqli_error($con));
        }
}
 
    // selecting cart items 
    $select_cart_items="select * from cart_details where ip_address='$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script> alert('You ahve items in your cart')</script>";
        echo"<script>window.open('checkout.php','_self')</script>";
   }else{
    echo"<script>window.open('../index.php','s_elf')</script>";
   }
   }
    ?>
