let navbar = document.querySelector('.header .navbar');
let userBox = document.querySelector('.header .user-box');

document.querySelector('#user-btn').onclick = () =>{
    
    userBox.classList.toggle('active');
    navbar.classList.remove('active');

}

document.querySelector('#menu-btn').onclick = () =>{
    
    navbar.classList.toggle('active');
    userBox.classList.remove('active');

}

window.onscroll = () =>{
    
    userBox.classList.remove('active');
    navbar.classList.remove('active');

   if(window.scrollY > 60){
    
    document.querySelector('.header').classList.add('active');
   
   }else{
    
    document.querySelector('.header').classList.remove('active');
   
   }
}

//enter coupon on input click

function Coupon(){
    
    var coupon = $('#coupon').val();
    var price = $('#price').val();
    
    if(coupon == ""){
        
        alert("Please enter a coupon code!");
    
    }else{
        
        $.post('user_discount.php', {coupon: coupon, price: price}, function(data){
            
            if(data == "error"){
                
                // alert("Invalid Coupon Code!");
                $('#total').val(price);
                $('#result').html('');
            
            }else{
                
                var json = JSON.parse(data);
                $('#result').html("<h4 class='pull-right text-danger'>"+json.discount+"% Off</h4>");
                $('#total').val(json.price);
            
            }
        });
    }
}

// get value from input and post it in a output

function Total(){
    
    var final = $("#total").val();
    //alert(final);
    
    $.post('final.php', {Total: final}, function(data){

        if(data == "error"){

            alert("unable to connect");

        }

        else{

            // alert("perfect");
            window.location.href = "user_final_pay.php";

        }
    });
}
