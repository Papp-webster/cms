$(document).ready(function(){
   

     // Load more data
    $('.loadmore').click(function(){
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        row = row + 3;

        if(row <= allcount){
            $("#row").val(row);

            $.ajax({
                url: 'post_load.php',
                type: 'post',
                data: {row:row},
                beforeSend:function(){
                    $(".loadmore").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    
                        // appending posts after last post with class="post"
                        $(".load:last").after(response).show().fadeIn();

                        var rowno = row + 3;

                        // checking row value is greater than allcount or not
                        if(rowno > allcount){

                            // Change the text and background
                            $('.loadmore').text("Kevesebb");
                            $('.loadmore').css("cursor","pointer");
                        }else{
                            $(".loadmore").text("Még több poszt..");
                            $(".loadmore").css("cursor", "pointer");
                        }
                    


                }
            });
        }else{
            $('.loadmore').text("Loading...");

            // Setting little delay while removing contents
            

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.load:nth-child(3)').nextAll('.load').remove().fadeIn();

                // Reset the value of row
                $("#row").val(0);

                // Change the text and background
                $('.loadmore').text("Még több poszt..");
                $('.loadmore').css("cursor","pointer");

            


        }

    });

});
