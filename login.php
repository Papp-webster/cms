<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './vendor/autoload.php';

if(ifItIsMethod('post')){

    $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['pass']);


  $error = [
    'username' => '',
    'email' => '',
    'pass' => ''

  ];

  if (strlen($username) < 4) {
    $error['username'] = 'Felhasználó név több karater legyen!';
  }

  if ($username == '') {
    $error['username'] = 'Felhasználó nem lehet üres!';
  }

  if (userName_exists($username)) {
    $error['username'] = 'Felhasználó név foglalt!';
  }



  if ($email == '') {
    $error['email'] = 'Email nem lehet üres!';
  }



  if (empty($password)) {
    $error['pass'] = 'A jelszó nem lehet üres!';
  }
  foreach ($error as $key => $value) {
    if (empty($value)) {

      unset($error[$key]);
    }
  } // foreach

  if (empty($error)) {
    register_user($username, $email, $password);
    login_user($username, $password);
  }


  $length = 50;
  $token = bin2hex(openssl_random_pseudo_bytes($length));
  if (email_exists($email)) {

    $stmt = mysqli_prepare($connect, "UPDATE users SET token='{$token}' WHERE user_email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    /* configure PHPMailer */
    $mail = new PHPMailer();
    $mail->isSendmail($email);
    $mail->Host       = Config::SMTP_HOST;                    // Set the SMTP server to send through
    $mail->Username   = Config::SMTP_USER;                     // SMTP username
    $mail->Password   = Config::SMTP_PASSWORD;                 // SMTP password
    $mail->Port       = Config::SMTP_PORT;                      // TCP port to connect to
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('msztesz@gmail.com', 'Msztesz');
    $mail->addAddress($email);
    $mail->Subject = 'Jelszó emlékeztető!';
    $mail->Body = '<p>Az új jelszó beállításához szükséges link:<a href="https://msztesz.hu/cms/reset.php?email=' . $email . '&token=' . $token . ' ">https://msztesz.hu/cms/reset.php?email= ' . $email . '&token=' . $token . '</a></p>';
    if ($mail->send()) {
      $error['email'] = 'Email elküldve!';
      $emailSent = true;
    } else {
      $error['email'] = 'Sikertelen küldés!';
    }
  }
  if(isset($_POST['user_name']) && isset($_POST['user_password'])){

    login_user($_POST['user_name'], $_POST['user_password']);


} else {


    redirect('/cms/profile.php');
}
    

}



?>




<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default mb-4">
                <div class="panel-body mt-4">
                    <div class="other-options">
                        <div class="option" id="newUser">
                            <p class="option-text"><i class="fa fa-user-plus"></i> Regisztráció</p>
                        </div>
                        <div class="option" id="oldUser">
                            <p class="option-text"><i class="fa fa-user"></i> Belépés</p>
                        </div>
                    </div>
                    <h1 id="form-main" class="text-center">Bejelentkezés</h1>
                    <form id="registration-form" action="/cms/" autocomplete="off" method="post">
                        <input class="user form-control" type="text" name="username"
                            value="<?php echo isset($username) ? $username : '' ?>" placeholder="Felhasználó név">
                        <p class="error text-center"><?php echo isset($error['username']) ?  $error['username'] : '' ?>
                        </p>

                        <input class="user form-control" type="email" name="email"
                            value="<?php echo isset($email) ? $email : '' ?>" placeholder="E-mail">
                        <p class="error text-center"><?php echo isset($error['email']) ?  $error['email'] : '' ?> </p>

                        <input class="user form-control" type="password" name="pass" placeholder="Jelszó">
                        <p class="error text-center mb-4">
                            <?php echo isset($error['password']) ?  $error['password'] : '' ?> </p>
                        <button class="btn login" name="sendin" type="send">Regisztráció</button>
                    </form>

                    <form id="login-form" action="/cms/login.php" autocomplete="off" method="post">
                        <input class="user form-control" type="text" name="user_name" placeholder="Felhasználó név">
                        <input class="user form-control" type="password" name="user_password" placeholder="Jelszó">
                        <button class="btn login" name="login" type="submit">Belépés</button>
                        <div class="option" id="getpass">
                            <p class="option-text"><i class="fa fa-key"></i> Jelszó emlékeztető</p>
                        </div>
                    </form>



                    <form id="fpass-form" method="post">
                        <input type="email" class="user form-control" name="email" placeholder="E-mail">
                        <button class="btn login" id="getpass-btn" name="forgot" type="submit">Küldés</button>
                        <p class="error text-center"><?php echo isset($error['email']) ?  $error['email'] : '' ?> </p>
                    </form>

                </div>
            </div>
        </div>


    </div>
</div>

<?php include "includes/footer.php";?>