<?php

require_once 'connection.php';
	
if(ISSET($_POST['save'])){
    
    $coupon_code = $_POST['coupon'];
	$discount = $_POST['discount'];
	$status = "Valid";
	$query = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code'") or die(mysqli_error());
	$row = mysqli_num_rows($query);
    
    if($row > 0){
        
        echo "<script>alert('Coupon Already Use')</script>";
        echo "<script>window.location = 'generate_coupon.php'</script>";
    
    }else{
        
        mysqli_query($conn, "INSERT INTO `coupon` VALUES('', '$coupon_code', '$discount', '$status')") or die(mysqli_error());
        echo "<script>alert('Coupon Saved!')</script>";
        echo "<script>window.location = 'generate_coupon.php'</script>";
    
    }
}

?>