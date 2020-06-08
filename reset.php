
<?php  include "includes/header.php"; ?>


<?php

if (!isset($_GET['email']) && !isset($_GET['token'])) {
  redirect('/cms/');
}



if($stmt = mysqli_prepare($connect, 'SELECT user_name, user_email, token FROM users WHERE token=?')){

  mysqli_stmt_bind_param($stmt, "s", $_GET['token']);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $user_name, $user_email, $token);

  mysqli_stmt_fetch($stmt);

  mysqli_stmt_close($stmt);



  if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {

    if($_POST['password'] === $_POST['confirmPassword']) {

    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

    if($stmt = mysqli_prepare($connect, "UPDATE users SET token='', user_password='{$hashedPassword}' WHERE user_email = ?")){


        mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_affected_rows($stmt) >= 1){

          $msg['password'] = 'A jelszó megváltozott! itt beléphet: <a href=/cms/>Főoldal</a>';

        }

        mysqli_stmt_close($stmt);


    }
    $msg['confirmPassword'] = 'A jelszó egyezik!';
  }else {
    $msg['confirmPassword'] = 'A jelszó nem egyezik!';
  }
}

}


?>

 <div class="container">
        <div class="row">
            <div class="col-lg-12">

            

                    <div class="form-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-2x"></i></h3>
                            <h2 class="text-center">Új jelszó</h2>
                            <p>Itt új jelszót igénylehet.</p>
                            
                            <div class="panel-body">


                                <form id="reset-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">

                                            <input id="password" name="password" placeholder="jelszó" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">

                                            <input id="confirmPassword" name="confirmPassword" placeholder="jelszó újra" class="form-control"  type="password">
                                        </div>
                                    </div>
                                         <p class="error text-center"><?php echo isset($msg['confirmPassword'])?  $msg['confirmPassword'] : ''?> </p>
                                      <p class="error text-center"><?php echo isset($msg['password'])?  $msg['password'] : ''?> </p>
                                    <div class="form-group">
                                        <input name="resetPassword" class="btn comm" value="Elküld" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->
                            

                       </div>
                    </div>
                
            </div>
            
        </div>
    </div>





