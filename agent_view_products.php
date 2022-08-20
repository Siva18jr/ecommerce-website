<?php

include 'connection.php';

session_start();

$agent_id = $_SESSION['agent_id'];

if(!isset($agent_id)){

   header('location:login.php');

};

if(isset($_POST['update_product'])){
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    
    mysqli_query($conn, "UPDATE `products` SET description='$des',price = '$price',name = '$name' WHERE id = '$id'") or die('query failed');
    
    if(!empty($image)){
        
        mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$id'") or die('query failed');
    
    }
    
    header('location:agent_view_products.php');

}

if(isset($_GET['delete'])){
    
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'");
    
   //  mysqli_query($conn, "DELETE products, agent_payment FROM products INNER JOIN agent_payment ON products.name = agent_payment.name WHERE products.id = '$delete_id'") or die('query failed');
    
    header('location:agent_view_products.php');

}

?>

<html>
<head>
    <title>adding products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="report.css">
</head>

<body style="background-color: black">

<?php

    include 'agent_header.php'; 

?>

<section class="user-table">
<h1 class="title"> products </h1><br>
   <table>
      <thead>
         <th>image</th>
         <th>product name</th>
         <th>price</th>
         <th>description</th>
         <th id="remove">action</th>
      </thead>
      <tbody>

         <?php
         
         $res = mysqli_query($conn, "SELECT * FROM `products` where user_id='$agent_id' order by name");
         
         if(mysqli_num_rows($res) > 0){
            
            while($row = mysqli_fetch_assoc($res)){
                
        ?>

         <tr>
            <td><img src="img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>₹<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['description']; ?></td>
            <td id="remove">
               <a id="remove" href="agent_view_products.php?update=<?php echo $row['id']; ?>" class="option-btn"><i class="fas fa-edit"></i>update</a><br>
               <a id="remove" href="agent_view_products.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');"><i class="fas fa-trash"></i> delete</a>
            </td>
         </tr>

         <?php
            };    
            }else{

               echo '<p class="empty">no products added yet!</p>';
            
            };
         
         ?>

      </tbody>
   </table>
</section>

<section class="edit-product-form">
  <div id="wrapper">
    <div class="scrollbar" id="style-1">
        <div class="force-overflow">
   <?php

      if(isset($_GET['update'])){
        
        $update_id = $_GET['update'];
        
        $res = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
        
        if(mysqli_num_rows($res) > 0){
            
            while($row = mysqli_fetch_assoc($res)){
                
    ?>
    
    <form action="agent_view_products.php" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
      <img src="img/<?php echo $row['image']; ?>" alt="">
      <input type="text" name="name" value="<?php echo $row['name']; ?>" class="box" required placeholder="enter product name">
      <input type="text" name="des" value="<?php echo $row['description']; ?>" class="box">
      <input type="text" name="price" value="<?php echo $row['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="file" class="box" name="image" accept="img/jpg, img/jpeg, img/png">
      <button type="submit" name="update_product" class="btn"><i class="fas fa-edit"></i> update</button>
      <button type="reset" class="delete-btn"><a href="agent_view_products.php"><i class="fa fa-times"></i>cancel</a></button>
   </form>
</div></div></div>
   <?php
         
        }
    }
        }else{
            
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        
        }
   ?>

</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src = "js/admin.js"></script>
</body>
</html>