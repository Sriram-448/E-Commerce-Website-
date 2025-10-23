<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<h3 class="text-center text-success">All orders</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
<?php
$get_orders="Select * from user_orders"; 
$result=mysqli_query($con,$get_orders);
$row_count=mysqli_num_rows($result);
echo "<tr>
<th>S1 no</th>
<th>UserId</th>
<th>Due Amount</th>
<th>Invoice number</th>
<th>Total products</th>
<th>Order Date</th>
<th>Status</th>
</tr>
</thead>
<tbody class='bg-secondary text-light'>";
if($row_count==0){

    echo "<h2 class='bg-danger text-center mt-5'>No orders yet</h2>";
    
    }else{
        $number=0;
        while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $amount_due=$row_data['amount_due'];
        $invoice_number=$row_data['invoice_number']; 
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status']; 
        $number++;
        echo" <tr>
        <td>$order_id</td>
        <td>$user_id</td>
        <td>$amount_due</td>
        <td>$invoice_number</td>
        <td>$total_products</td>
        <td>$order_date</td>
        <td>$order_status</td>
        </tr>";
    }
}
?>