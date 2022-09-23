<?php

require 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){

  header('location:login.php');

}

include 'add_to_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <script src="js/user.js"></script>
  <script>
        document.onreadystatechange = function () {
            
            var state = document.readyState
            
            if (state == 'interactive') {
                
                document.getElementById('contents').style.visibility="hidden";
            
            }
            
            else if (state == 'complete') {
                
                setTimeout(function(){
                    
                    document.getElementById('interactive');
                    document.getElementById('load').style.visibility="hidden";
                    document.getElementById('contents').style.visibility="visible";
                
                },1500);
            }
        }

    </script>
</head>

<body style="color:#fff">
  
  <div id="load">
  <div id="contents">

<?php include 'user_header.php'; ?>

<section class="home" id="home">
   <div class="content">
    </div>
</section>

<section class="dashboard">
  
  <h1 class="title" >TODAY COUPONS </h1><br>
  
  <div class="box-container">
    
    <?php
    
    $res = mysqli_query($conn,"SELECT coupon_code, discount FROM coupon");
    
    if(mysqli_num_rows($res)>0){
      
      $i = 1;
      
      while($row = mysqli_fetch_assoc($res)){
  
    ?>
    
    <div class = "box">
      
      <p><?php echo 'UPTO'.'<br>'.$row['discount'].'%'.' OFF ' ?></span></p>
          
      <input type="text" name="coupon_code" value="<?php echo $row['coupon_code']; ?>" id = "myInput_<?= $i ?>" class="box" readonly style = "color:green;" >


    </div>
    
    <?php
    
    $i++;
      
      }
        
    }else{
      
      echo "no coupons";
    
    }
    
    ?>
    
  </div>
  </section>
</body>
</div>
</div>
<footer>
<?php include 'footer.html' ; ?>
</footer>
</html>
