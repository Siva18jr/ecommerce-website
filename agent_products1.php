<?php

include 'connection.php';

session_start();

$agent_id = $_SESSION['agent_id'];

if(!isset($agent_id)){

   header('location:login.php');

};

if(isset($_POST['add_product'])){

    $name =  $_POST['name'];
    $agent_name =  $_POST['agent_name'];
    $types = $_POST['types'];
    $price = $_POST['price'];
    $des= $_POST['des'];
    $date = date("y-m-d");
    $image = $_FILES['image']['name'];
    $item_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');
    
    if(mysqli_num_rows($item_name) > 0){
        
        $message[] = 'product already added';
    
    }else{
        
        $query=mysqli_query($conn,"SELECT * FROM `products` INNER JOIN users ON products.user_id = users.id where user_id='$agent_id'") or die('query failed');
        
        if(mysqli_num_rows($query) > 0){
            
            $res = mysqli_query($conn, "INSERT INTO `products`(user_id, name, agent_name, types, price, image, description, placed_on) VALUES('$agent_id','$name', '$agent_name', '$types', '$price', '$image', '$des', '$date')");
            
            if($res){
                
                $message[] = 'one item added successfully!';
            
            }else{
                
                $message[] = 'item added unsuccessfully!';
            
            }
        }
    }
}

?>

<html>
<head>
   <title>adding products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin.css">
</head>
<body style="background-color: black">

<?php 

    include 'agent_header.php';
    
?>

<section class="add-products">

   <h1 class="title">products</h1>

   <form action="agent_products.php" method="post" enctype="multipart/form-data">
      <h3>add products</h3>
      <input type="text" name="name" class="box" placeholder="enter product name" >
      <input type="text" name="types" class="box" placeholder="enter product type" >
      <input type="number" min="0" name="price" class="box" placeholder="enter price" >
      <input type="file" name="image" accept="img/jpg, img/jpeg, img/png" class="box" >
      <input type="text" name="des" class="box" placeholder="enter description" >
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>
</section>
<script src = "js/admin.js"></script>
</body>
</html>
