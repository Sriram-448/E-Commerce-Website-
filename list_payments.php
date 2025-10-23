<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
<?php
$get_payments = "SELECT * FROM user_payments"; 
$result = mysqli_query($con, $get_payments);
$row_count = mysqli_num_rows($result);
echo "<tr>
        <th>OrderId</th>
        <th>Amount</th>
        <th>Invoice Number</th>
        <th>Payment Mode</th>
        <th>Order Date</th>
        <th>Payment Date</th>
      </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
if($row_count == 0){
    echo "<h2 class='bg-danger text-center mt-5'>No payments received yet</h2>";
} else {
    while($row_data = mysqli_fetch_assoc($result)){
        $order_id = $row_data['order_id'];
        $amount = $row_data['amount'];
        $invoice_number = $row_data['invoice_number'];
        $payment_mode = $row_data['payment_mode']; 
        $payment_date = $row_data['date'];
        $date = $row_data['date'];
        
        echo "<tr>
                <td>$order_id</td>
                <td>$amount</td>
                <td>$invoice_number</td>
                <td>$payment_mode</td>
                <td>$payment_date</td>
                <td>$date</td>
              </tr>";
    }
}
?>
</tbody>
</table>
