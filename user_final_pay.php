<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    
    header('location:login.php');

}

if(isset($_POST['order_btn'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('Y-m-d');
    $final_total = 0;
    $cart_items[] = '';
    $result1 = mysqli_query($conn, "SELECT * FROM `cart` INNER JOIN products ON products.id = cart.p_id WHERE cart.user_id = '$user_id'") or die('query failed');
    
    if(mysqli_num_rows($result1) > 0){
        
        while($row1 = mysqli_fetch_assoc($result1)){
            
            $cart_items[] = $row1['name'].' ('.$row1['quantity'].') ';
            $total = $row1['total_price'];
            $final_total = $total;
        
        }
    }
    
    $total_products = implode(', ',$cart_items);
    
    $result2 = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' AND name='$name' AND number = '$number' AND email = '$email' AND method = '$method' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$final_total'") or die('query failed...');
    
    if($final_total == 0){
        
        $message[] = 'your cart is empty';
    
    }else{
        
        if(mysqli_num_rows($result2) > 0){
            
            $message[] = 'order already placed!';
        
        }else{
            
            mysqli_query($conn, "INSERT INTO `orders`(user_id,name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$final_total', '$placed_on')") or die('query failed');
            
            $message[] = 'order placed successfully!';
            
            echo '<script>alert("order placed successfully!")</script>';
            
            header('location:user_dispay.php');
        
        }
    }
}

?>

<html>
<head>
   <title>user-order</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="user.css">
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function(){
         $("#state").on('input',function(){
            
            var state = $("#state").val();
         
	      $("#city option").each(function() {
            
            var $thisOption = $(this);
            var valueToCompare = state;
            
            if($thisOption.val() == valueToCompare) {
            
            
               $thisOption.attr("disabled", false);
   
            }else{
            
               $thisOption.css("display", "none");
         
            }
         });
         });
      });
   </script>
</head>

<body>
<?php include 'user_header.php'; ?>
<section class="display-order">
   
   <?php
   
   $final_price = 0;
   
   $result3 = mysqli_query($conn, "SELECT * FROM `cart` INNER JOIN products ON products.id = cart.p_id WHERE cart.user_id = '$user_id'") or die('query failed');
   
   if(mysqli_num_rows($result3) > 0){
    
    while($row3 = mysqli_fetch_assoc($result3)){
        
        $total_price = $row3['total_price'];
        $final_price = $total_price;
        
    ?>

   <p> <?php echo $row3['name']; ?> </p>
   
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

<section class="user-orders">
   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>

          <input type="hidden" id="method"  value="Online Transaction" name = "method" readonly>
          
         <div class="inputBox">
            <span>Flat/House No :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no/house no.">
         </div>
         <div class="inputBox">
            <span>Street Name :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <select name="state" id = "state" oninput = "State()">
               
               <?php
               
               $sql = "SELECT * FROM state_list ";
               $res = mysqli_query($conn, $sql);
               
               while($state = mysqli_fetch_array($res,MYSQLI_ASSOC)):;
               
               ?>
               
               <option value="<?php echo $state['id'];?>" >
               <?php echo $state['state'];?>
               </option>
               
               <?php
               
               endwhile;
               
               ?>
            
            </select>

         </div>

         <!-- <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" id="city" required placeholder="city name">
         </div> -->

         <div class="inputBox">
            <span>City :</span>
            <select name="city" id="city">
               
               <?php

               $sq = "SELECT * FROM all_cities";
               $res1 = mysqli_query($conn, $sq);
               
               while($city = mysqli_fetch_array($res1,MYSQLI_ASSOC)):;
               
               ?>
               
               <option value="<?php echo $city['state_code'];?>" disabled="disabled">
               <?php echo $city['city_name'];?>
               </option>
               
               <?php
            
               endwhile;
            
               ?>
            
            </select>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <select name="country">
               <option value="india">india</option>
            </select>
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <center>
	      <a href="user_cart.php" class="remove-btn" >Back</a>
	      <input type="submit" value="order now" class="btn" name="order_btn">
     </center>
   </form>
</section>
<script src="js/user.js"></script>
</body>
<footer>
<?php include 'footer.html' ; ?>
</footer>
</html>
