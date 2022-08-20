<?php

include 'connection.php';

session_start();

$agent_id = $_SESSION['agent_id'];

if(!isset($agent_id)){
    
    header('location:login.php');

}

?>

<html>
<head>
   <title>Rules</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin.css">
</head>

<style>

.products .box-container{
    max-width: 1200px;
    margin:0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, 110rem);
    align-items: flex-start;
    gap:1.5rem;
    justify-content: center;
    background-color: black;
 } 
 .products .box-container .box{
    border:.1rem solid rgba(255,255,255,.3);
    padding:1.2rem 1.4rem;
    justify-content: center;
    background-color: #13131a;
 }  
 .products .box-container .box p{
    font-size: 1.5rem;
}
.products .box-container .box p span{
    color:#d3ad7f;
    font-size: 2rem;
}
u{
    text-decoration: underline;
    color:blue;
}

</style>

<body  style="background-color: black; color:#fff">

<?php include 'agent_header.php'; ?>

<section class="products">
    <div class="box-container">
    <h1 class="title"> <span>about </span>us</h1>
    <div class="box">

<center>
<p><span>&nbsp; <i class="fa-solid fa-house" style="color:#d3ad7f"></i> Address : </span>&nbsp;101,Mobzon,<br>&nbsp; leeds, England.</p></center>
</div>
</div>
</section>
<script src = "js/admin.js"></script>
</body>
</html>