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
   <title>products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="user1.css">
</head>

<body style="color:#fff"> 

<?php include 'user_header.php'; ?><br>
<h1 class="heading"> <span></span>
<br>
<section class="products">
    <h1 class="heading">
        <section class="product_theme">
        <a href="product_type.php?types=Laptop">laptop</a>
        <a href="product_type.php?types=Mobile">mobile</a>
        <a href="product_type.php?types=Ipad">ipad</a>
        <a href="product_type.php?types=Tablet">tablet</a>
</section>
<br>
    <section class="products">
    <h1 class="heading"> ALL <span> products</span></h1>
    <h3 class="heading1"></h3>
    <div class="box-container">
      <?php

      $res = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      
      if(mysqli_num_rows($res) > 0){
        
        while($row = mysqli_fetch_assoc($res)){
            
            include 'products.php';
        
        }
    
    }else{
        
        echo '<h4>no products added yet!</h4>';
    
    }
      ?>

</div>
</section>
<script src = "js/product.js"></script>
</body>
    <footer>
<p class="pagetop"><a href="#"><i class="fas fa-angle-double-up"></i></a></p>
<?php include 'footer.html' ; ?>
</footer>
</html>
