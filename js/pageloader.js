$(document).ready(function(){
   var postCount = 4;
 $("#btn-load").click(function(){
    postCount = postCount + 1;
   $("#load").load("post_load.php", {
     postNewCount: postCount
   });
 });

});
