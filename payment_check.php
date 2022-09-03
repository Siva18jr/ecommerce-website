<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    
    header('location:login.php');

}

if(isset($_POST['update_status'])){
    
    $update_id = $_POST['id'];
    $update = $_POST['status'];
    
    mysqli_query($conn, "UPDATE `payment` SET status = '$update' WHERE user_id = '$update_id'") or die('query failed');
    $message[] = 'payment status has been updated!';

}

?>

<html>
<head>
   <title>orders</title>
</head>

<style>

input[type="date"]::-webkit-calendar-picker-indicator{
      filter:invert(1);
}

</style>

<body style="background-color: black">

<?php include 'admin_header.php'; ?>

<section id="remove" class="orders">
   <h1 class="title">payment details</h1>
</section>
<section class="user-table">
   <table>
      <thead>
         <th>id</th>
         <th>name</th>
         <th>total price</th>
         <th>status</th>
         <th>method</th>
         <th>paid on</th>
      </thead>
      <tbody>
        
        <?php
        
        $result = mysqli_query($conn, "SELECT * FROM `payment` INNER JOIN users ON payment.user_id = users.id");
        
        if(mysqli_num_rows($result) > 0){
            
            while($row = mysqli_fetch_assoc($result)){
        
        ?>
         
         <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['total_price']; ?></td>
            <td>
            <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <select name="status">
               <option value="" selected disabled><?php echo $row['status']; ?></option>
               <option value="cash received">Cash received</option>
               <option value="payment successfull">payment successfull</option>
               <option value="transaction failed">transaction failed</option>
            </select>
            <button type="submit" name="update_status" class="btn"><i class="fas fa-edit"></i>update<button>
               </form>   
                </td>
            <td><?php echo $row['method']; ?></td>
            <td><?php echo $row['paid_on']; ?></td>
         </tr>

         <?php
            };    
            }else{
               echo '<p class="empty">no payments received yet!</p>';
            };
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="js/admin.js"></script>
</body>
</html>