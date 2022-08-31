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

$(document).ready(function() {
    
    var pagetop = $('.pagetop');
    
    $(window).scroll(function () {
        
        if ($(this).scrollTop() > 1500) {
            
            pagetop.fadeIn();
        
        } else {
            
            pagetop.fadeOut();
        
        }
    });
    
    pagetop.click(function () {
        
        $('body, html').animate({ scrollTop: 0 }, 400);
        return false;
    
    });
});