<?php include "includes/header.php"; ?>

<?php

echo loggedInUserId();

if(userLiked(45)){
    echo "User liked!";
}else{
    echo "user Not liked!";
}