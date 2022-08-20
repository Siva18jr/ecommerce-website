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
   <title>category</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="user.css">
</head>
<body>

<?php 

include 'user_header.php'; 

?>
<section class="products">
    <h1 class="heading"><span><?php echo $_GET['agent_name'];?></span> agent <a href="#all"><span>&#8594;</a></span></h1>
<div class="box-container">
    
    <?php
    
    $agent_name = $_GET['agent_name'];
    
    $res = mysqli_query($conn, "SELECT * FROM `products` where agent_name= '$agent_name'") or die('query failed');
    
    if(mysqli_num_rows($res) > 0){
        
        while($row = mysqli_fetch_assoc($res)){
            
            include 'products.php';
        
        }
    
    }else{
        
        echo '<p class="empty">no products added yet!</p>';
    }
   
   ?>

</div>
</section>
<script src="js/admin.js"></script>
</body>
</html>