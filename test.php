<?php include "includes/header.php"; ?>

<?php

echo loggedInUserId();

if(userLiked(47)){
    echo " User liked!";
}else{
    echo " user Not liked!";
}