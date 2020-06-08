
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
