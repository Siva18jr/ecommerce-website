<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    
    header('location:login.php');

}

if(isset($_POST['update_coupon'])){
    
    $id = $_POST['coupon_id'];
    $code = $_POST['coupon_code'];
    $discount = $_POST['discount'];
    
    mysqli_query($conn, "UPDATE coupon SET coupon_code = '$code', discount = '$discount' WHERE coupon_id = '$id'") or die('query failed');
    
    header('location:generate_coupon.php');

}

if(isset($_GET['delete'])){
    
    $delete_id = $_GET['delete'];
    
    mysqli_query($conn, "DELETE FROM coupon WHERE coupon_id = '$delete_id'") or die('query failed');
    
    header('location:generate_coupon.php');

}

?>

<html>
	<head>
		<title>coupon</title>
		<link rel="stylesheet" type="text/css" href="admin.css" />
		<link rel="stylesheet" href="admin_dashboard.css">
	</head>

	<body style="background-color: black">

	<?php include 'admin_header.php'; ?>

	<section class="dashboard">
		
		<form action="save_coupon.php" method="POST">
			
			<h1 class="title"> create coupon </h1><br>
			
			<div class="box-container">
				
				<div class="box">
					
					<label>COUPON CODE </label>
					<input type="text" class="form-control" name="coupon" id="coupon" required="required" />
					<br>
					<br>
					<label>DISCOUNT (%)</label>
					<input type="number" class="form-control" name="discount" min="10" required="required" />
					<br>
					<br>
					<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
				
				</div>
			</div>
		</form>
	</section>

	<section class="user-table">
		
		<h1 class="title"> coupons </h1><br>
   <table>
      <thead>
         <th>coupons</th>
         <th>discount</th>
         <th id="remove">action</th>
      </thead>
      <tbody>

         <?php
         
         $res = mysqli_query($conn, "SELECT * FROM coupon ");
         
         if(mysqli_num_rows($res) > 0){
            
            while($row = mysqli_fetch_assoc($res)){
                
        ?>

         <tr>
            <td><?php echo $row['coupon_code']; ?></td>
            <td><?php echo $row['discount']; ?>%</td>
            <td id="remove">
               <a id="remove" href="generate_coupon.php?update=<?php echo $row['coupon_id']; ?>" class="option-btn"><i class="fas fa-edit"></i>update</a>
               <a id="remove" href="generate_coupon.php?delete=<?php echo $row['coupon_id']; ?>" class="delete-btn" onclick="return confirm('delete this coupon?');"><i class="fas fa-trash"></i> delete</a>
            </td>
         </tr>

         <?php

            };    
            }else{

               echo '<p class="empty">no products added yet!</p>';
            
            };
         
         ?>

      </tbody>
   </table>

   <section class="edit-product-form">
  <div id="wrapper">
    <div class="scrollbar" id="style-1">
        <div class="force-overflow">
   <?php

      if(isset($_GET['update'])){
        
        $update_id = $_GET['update'];
        
        $res = mysqli_query($conn, "SELECT * FROM coupon WHERE coupon_id = '$update_id'") or die('query failed');
        
        if(mysqli_num_rows($res) > 0){
            
            while($row = mysqli_fetch_assoc($res)){
                
    ?>
    
    <form action="generate_coupon.php" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="coupon_id" value="<?php echo $row['coupon_id']; ?>">
      <input type="text" name="coupon_code" value="<?php echo $row['coupon_code']; ?>" class="box" required placeholder="enter product name">
      <input type="text" name="discount" value="<?php echo $row['discount']; ?>" class="box" required placeholder="enter product type">
      <button type="submit" name="update_coupon" class="btn"><i class="fas fa-edit"></i> update</button>
      <button type="reset" class="delete-btn"><a href="generate_coupon.php"><i class="fa fa-times"></i>cancel</a></button>
   </form>
</div></div></div>
   <?php
         
        }
    }
        }else{
            
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        
        }
   ?>
   </section>
   
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src = "js/admin.js"></script>
</body>
</html>