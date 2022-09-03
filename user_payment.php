<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    
    header('location:login.php');

}

if(isset($_POST['pay'])){
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $total_price = $_POST['total'];
    $method = $_POST['method'];
    $paid = date('Y-m-d');

    if($total_price == 0){

        header('location:user_cart.php');

        echo '<script>alert("payment unsuccessfull!")</script>';

    }else{
        
        mysqli_query($conn,"INSERT INTO payment (user_id, name, card_number, total_price, method, paid_on) VALUES('$user_id', '$name', '$number', '$total_price', '$method', '$paid')") or die('query failed');
        
        echo '<script>alert("payment successfull!")</script>';
        
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        
        header('location:user_end.html');
    
    }

}

if(isset($_POST['cash'])){
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $total_price = $_POST['total'];
    $meth = $_POST['meth'];

    if($total_price == 0){

        header('location:user_cart.php');

        echo '<script>alert("an error occurred")</script>';

    }else{
        
        mysqli_query($conn,"INSERT INTO payment (user_id, name, total_price, method) VALUES('$user_id', '$name', '$total_price', '$meth')") or die('query failed');
        
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        
        header('location:user_bye.html');
    
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="user_payment.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>
<section class="display-order">
   
   <?php
   
   $final_price = 0;
   
   $result3 = mysqli_query($conn, "SELECT * FROM `cart` INNER JOIN products ON products.id = cart.p_id WHERE cart.user_id = '$user_id'") or die('query failed');
   
   if(mysqli_num_rows($result3) > 0){
    
    while($row3 = mysqli_fetch_assoc($result3)){
        
        $total_price = ($row3['price'] * $row3['quantity']);
        $final_price += $total_price;
        
    ?>
   
   <p> <?php echo $row3['name']; ?> <span>(<?php echo '₹'.$row3['price'].'/-'.'  '. $row3['quantity']; ?>)</span> </p>
   
   <?php
   
        }
    }else{
        
        echo '<p class="empty">your cart is empty</p>';
    
    }
   
   ?>
   
   <br><center>
   <br><hr width="50%" color="grey" size="3"></center>
   <div class="grand-total"> grand total : <span>₹<?php echo $final_price; ?>/-</span> </div>
</section>
<section class="payment-form dark">
    <div class="container">
        <div class="block-heading">
            <h2>ONLINE PAYMENT</h2>
        </div>
        <form action="" method="post">
            <div class="products">
                <h3 class="title">Checkout</h3>
                <div class="card-details">
                    <h3 class="title">Credit / Debit Card Details</h3>
                    
                    <div class="row">
                        
                        <div class="form-group col-sm-7">
                            <label for="card-holder">Card Holder</label>
                            <input id="card-holder" name="name" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1" required>
                        </div>
                        
                        <div class="form-group col-sm-5">
                            <label for="">Expiration Date</label>
                            <div class="input-group expiration-date">
                                <input type="text" class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1" >
                                <span class="date-separator">/</span>
                                <input type="text" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-8">
                            <label for="card-number">Card Number</label>
                            <input id="card-number" type="text" name = "number" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1" required>
                        </div>
                        
                        <div class="form-group col-sm-4">
                            <label for="cvc">Code</label>
                            <input id="cvc" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1" required>
                        </div>
                        
                        <input type="hidden" id="method"  value="Online Transaction" name = "method" readonly>

                        <div class="form-group col-sm-7">
                            <label for="card-number">AMOUNT TO PAY</label>
                            <input type="text" name="total" required placeholder="amount" class="form-control" value="<?php echo $final_price; ?>" aria-describedby="basic-addon1"  readonly>
                        </div>
                            
                        <div class="form-group col-sm-12">
                            <!-- <button type="button" class="btn btn-primary btn-block" name = "pay"> Proceed</button> -->
                            <input type="submit" value="pay" class="btn" name="pay" >
                            <a href="user_products.php" class = "remove-btn" >Cancel Payment</a>
                        </div>
                    
                    </div>
                </div>
            </div>   
        </form>
    </div>
</section>
<section class="payment">
    <div class="box-container">
        <form action = "" method = "post">
            
            <div class="box">
                
                <div class="input-group">
                    
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Name</span>
                    </div>
                    
                    <input type="text" class="form-control" name = "name" placeholder = "                             enter your name here                 " required = "required">
                    <input type="text" class="form-control" name = "total" required placeholder="total" class="form-control" value="<?php echo $final_price; ?>" readonly>
                
                </div>
                
                <input type="hidden" id="method"  value="cash on delivery" name = "meth" readonly>
                
                <input type="submit" value="Payment on Delivery" class="btn btn-primary " name="cash">
            
            </div>

        </form>
    </div>
</section>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>