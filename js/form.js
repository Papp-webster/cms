// Side-navigation

const mainNavigation = document.querySelector(".main-navigation");
const overlay = mainNavigation.querySelector(".overlay");
const toggler = mainNavigation.querySelector(".navbar-toggler");

const openSideNav = () => mainNavigation.classList.add("active");
const closeSideNav = () => mainNavigation.classList.remove("active");

document.addEventListener("swiped-right", openSideNav);
document.addEventListener("swiped-left", closeSideNav);
toggler.addEventListener("click", openSideNav);
overlay.addEventListener("click", closeSideNav);





// FROM

$("#newUser").click(function(){
  $("#form-main").text("Regisztráció");
  $("#fpass-form").fadeOut(200);
  $("#login-form").fadeOut(200);
  $("#registration-form").delay(300).fadeIn(500);
  $("#newUser").fadeOut(200);
  $("#oldUser").fadeIn(300);

});


$("#oldUser").click(function(){
  $("#form-main").text("Bejelentkezés");
  $("#registration-form").fadeOut(200);
  $("#fpass-form").fadeOut(200);
  $("#login-form").delay(300).fadeIn(500);
  $("#newUser").fadeIn(300);
  $("#oldUser").fadeOut(200);

});

$("#getpass").click(function(){
  $("#form-main").text("Új jelszó");
  $("#login-form").fadeOut(200);
  $("#registration-form").fadeOut(200);
  $("#fpass-form").delay(300).fadeIn(500);
  $("#oldUser").fadeIn(300);
  $("#newUser").fadeOut(300);

});

// Top up 

(function($) {


  jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 1) {
        jQuery('.dmtop').css({bottom:"25px"});
    } else {
        jQuery('.dmtop').css({bottom:"-100px"});
    }
});
jQuery('.dmtop').click(function(){
    jQuery('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});

})(jQuery);

