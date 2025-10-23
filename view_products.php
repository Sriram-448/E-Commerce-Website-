 <!-- font awesome link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<h3 class="text-center text-success">All Products</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
<tr>
<th>Product ID</th>
<th>Product Title</th>
<th>Product Image</th>
<th>Product Price</th>
<th>Total Sold</th>
<th>Status</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
    $get_products="SELECT * FROM products";
    $result=mysqli_query($con,$get_products);
    $number=0; 
    while($row=mysqli_fetch_assoc($result)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $status=$row['status'];
        $number++;
    ?>
    <tr class='text-center'>
        <td><?php echo $number;?></td>
        <td><?php echo $product_title; ?></td>
        <td><img src='./product_images/<?php echo $product_image1; ?>' class='product_img'/></td>
        <td><?php echo $product_price; ?>/-</td>
        <td><?php 
            $get_count="SELECT * FROM orders_pending WHERE product_id=$product_id";
            $result_count=mysqli_query($con,$get_count);
            $rows_count=mysqli_num_rows($result_count);
            echo $rows_count;
        ?></td>
        <td><?php echo $status; ?></td>
        <td><a href='index.php?edit_products=<?php echo $product_id?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_product=<?php echo $product_id?>'type="button" class="text-light"data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
    </tr>
    <?php
    }
    ?>
</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <h4>Are you sure you want to delete this? </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?view_categories" class='text-light text-decoration-none'>No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php? delete_categories=<?php echo $categorie_id?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>