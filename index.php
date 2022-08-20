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
    <title>Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="user.css">
</head>

<body style="color:#fff"> 

<?php include 'user_header.php'; ?>
<section class="home" id="home">
   <center><video src="img/art-at-home-desktop.mp4" width="90%" id="video" autoplay muted loop></video></center><br>
   <div class="content">
    </div>
</section>
<!-- <section class="products">
<h1 class="heading"> our <span>Products</span> <a href="#all"><span>&#8594;</a></span></h1>
<div class="box-container">
   
</div>
<div class="load-more" style="margin-top: 2rem; text-align:center">
   <a href="user_products.php" class="btnn">Load more</a>
</div>
</section> -->
<script src="js/script.js"></script>
</body>
</html>