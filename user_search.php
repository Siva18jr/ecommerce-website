<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    
    header('location:login.php');

}

include 'add_to_cart.php';

?>

<html>
<head>
   <title>search page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="user.css">
</head>

<body style="color:#fff"> 

<?php include 'user_header.php'; ?>
<section class="search-form">
<h1 class="heading"><span>SEARCH ITEMS</span> <a href="user_search.php"><span>&#8594;</a></span></h1>
   <form action="" method="post">
      <input type="text" name="search" placeholder="search products..." class="box">
      <input type="submit" name="submit" value="search" class="search-btn">
   </form>
</section>
<section class="products" style="padding-top: 10;">
   <div class="box-container">
   
   <?php
   
   if(isset($_POST['submit'])){
        
        $search_prod = $_POST['search'];
        
        $res = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_prod}%' OR agent_name LIKE '%{$search_prod}%'") or die('query failed');
        
        if(mysqli_num_rows($res) > 0){
            
            while($row = mysqli_fetch_assoc($res)){
                
                include 'products.php';
            
            }
        
        }else{
            
            echo '<h1>no items found!</h1>';
   
        }
    
    }
?>
</div>
</section>
<script src="js/user.js"></script>
</body>
</html>