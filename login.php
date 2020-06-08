<?php include "includes/header.php"; ?>


<?php

if (isset($_POST['login'])) {

 login_user($_POST['user_name'], $_POST['user_password']);

}


?>
