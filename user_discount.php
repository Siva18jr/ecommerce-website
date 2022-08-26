<?php

require_once 'connection.php';

$coupon_code = $_POST['coupon'];
$price = $_POST['price'];

$query = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code' && `status` = 'Valid'") or die(mysqli_error());
$count = mysqli_num_rows($query);
$fetch = mysqli_fetch_array($query);
$array = array();

if($count > 0){
    
    $discount = $fetch['discount'] / 100;
    $total = $discount * $price;
    $array['discount'] = $fetch['discount'];
    $array['price'] = round($price - $total);

    // $prices = $array['price'];
    //$query = mysqli_query($conn, "UPDATE cart SET total_price = '$prices'") or die(mysqli_error());
    
    echo json_encode($array);

}else{
    
    echo "error";

}

// echo "ok";

// function myfinal(){

   
//     $prices = $_POST['total'];
//     $query1 = mysqli_query($conn, "UPDATE cart SET total_price = '$prices'") or die(mysqli_error());

// }

?>