<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<h3 class="text-center text-success">All users</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
<?php
$get_users = "SELECT * FROM user_table"; 
$result = mysqli_query($con, $get_users);
$row_count = mysqli_num_rows($result);
echo "<tr>
        <th>SLNO</th>
        <th>Username</th>
        <th>User email</th>
        <th>User address</th>
        <th>User mobile</th>
      </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
if($row_count == 0){
    echo "<h2 class='bg-danger text-center mt-5'>No users received yet</h2>";
} else {
    while($row_data = mysqli_fetch_assoc($result)){
        $user_id = $row_data['user_id'];
        $username = $row_data['username'];
        $user_email = $row_data['user_email'];
        $user_address = $row_data['user_address']; 
        $user_mobile = $row_data['user_mobile'];
    
        
        echo "<tr>
                <td>$user_id</td>
                <td>$username</td>
                <td>$user_email</td>
                <td>$user_address</td>
                <td>$user_mobile</td>
              </tr>";
    }
}
?>
</tbody>
</table>
