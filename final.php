<?php

require_once 'connection.php';

$total = $_REQUEST['Total'];

$query = mysqli_query($conn, "UPDATE cart SET total_price = '$total'") or die(mysqli_error());

?>
