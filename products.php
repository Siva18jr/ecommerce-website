<form action ="" method="post" class="box">
        <div class = "image"><img src="img/<?php echo $row['image']; ?>" alt=""></div>
        <div class = "name"><?php echo $row['name']; ?></div>
        <h2>₹<?php echo $row['price']; ?>/-</h2>
        <p>Description: <span><?php echo $row['description']; ?></span></p>
        <p>Quantity: <input type="number" min="1" name="quantity" value="1" class="qty"></p>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
        <input type="hidden" name="agent_name" value="<?php echo $row['agent_name']; ?>">
        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
        <input type="hidden" name="des" value="<?php echo $row['description']; ?>">
        <input type="hidden" name="image" value="<?php echo $row['image']; ?>">

        <input type="submit" value="Add to cart" name="add_to_cart" class="btnn"><br><br>
</form> 