<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
	<div class="navbar-header d-flex col">
		<a class="navbar-brand" href="/cms"><img src="/cms/img/logo02.png"  alt="logo"></a>  		
		<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	</div>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<ul class="nav navbar-nav">
        <?php
      
$query = "SELECT * FROM kategoriak";
$select_all_cat_query = mysqli_query($connect, $query);
while ($row = mysqli_fetch_assoc($select_all_cat_query)) {
  $cat_cim = $row['cat_cim'];
  $cat_id = $row['cat_id'];

  $category_class = '';

  if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
    $category_class = 'active';

  }

  echo "<li class='$category_class'><a class='nav-link' href='/cms/category/$cat_id'>{$cat_cim}</a></li>";
}
?>

  <?php if (is_admin($_SESSION['username'])): ?>
    <li>
        <a class="nav-link" href="/cms/admin" target="_blank">Admin</a>
    </li>
  <?php endif; ?>



   <?php

   if(is_admin($_SESSION['username'])) {

       if(isset($_GET['p_id'])) {

         $the_post_id = $_GET['p_id'];

       echo "<li><a href='/cms/admin/post.php?source=edit_post&p_id={$the_post_id}' class='nav-link' target='_blank'>Edit Post</a></li>";

       }

   }

   ?>

   <li>

		</ul>
		<form action="/cms/search" method="post">
            <div class="box">
                <input class="insearch" name="search" type="text">
                <span class="search">
                    <button name="send" class="btn btn-default" type="send">
                   </button>
                </span>
              </div>
            </form>
		<ul class="nav navbar-nav navbar-right ml-auto">
    
  <?php if (isset($_SESSION['user_role'])): ?>

<?php if (empty($_SESSION['user_image'])): ?>
  <li>

  <img class="img-responsive rounded-circle" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" width="40"
          alt="default picture"></li>

<?php else: ?>
  <li><img class="img-responsive rounded-circle" src="/cms/img/<?php echo $_SESSION['user_image']; ?>" width="40"
    alt="User picture"></li>


<?php endif; ?>
<li class="nav-item"><span class="users">
  <strong>Üdvözöljük,</strong>
  <?php echo $_SESSION['username']; ?>
</span></li>

<li><a class="nav-item" href="/cms/includes/logout.php">
<i class="fa fa-power-off"></i>
<strong>Kilépés</strong>
</a></li>
<?php else: ?>
  
 <a class="login-trigger" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-user-plus"></i> Bejelentkezés</a>
<?php endif; ?>
</ul>			
	
		
	</div>
</nav>




<!-- modal registration -->
 <div id="login" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <div class="modal-content">

           <?php
           use PHPMailer\PHPMailer\PHPMailer;
           use PHPMailer\PHPMailer\SMTP;
           use PHPMailer\PHPMailer\Exception;


           require './vendor/autoload.php';
           user_validation();

           ?>


      <div class="modal-body fix">
        <button data-dismiss="modal" class="close">&times;</button>
        <div class="other-options">
          <div class="option" id="newUser"><p class="option-text"><i class="fa fa-user-plus"></i> Regisztráció</p></div>
          <div class="option" id="oldUser"><p class="option-text"><i class="fa fa-user"></i> Belépés</p></div>


        </div>
        <h1 id="form-main" class="text-center">Bejelentkezés</h1>
        <form  id="registration-form" action="/cms/" autocomplete="off" method="post">
          <input class="user form-control" type="text" name="username" value="<?php echo isset($username) ? $username : ''?>" placeholder="Felhasználó név">
              <p class="error text-center"><?php echo isset($error['username'])?  $error['username'] : ''?> </p>

          <input class="user form-control" type="email" name="email" value="<?php echo isset($email) ? $email : ''?>" placeholder="E-mail">
             <p class="error text-center"><?php echo isset($error['email'])?  $error['email'] : ''?> </p>

          <input class="user form-control" type="password" name="pass" placeholder="Jelszó">
          <p class="error text-center mb-4"><?php echo isset($error['password'])?  $error['password'] : ''?> </p>
          <button class="btn login" name="sendin" type="send">Regisztráció</button>
        </form>

        <form id="login-form" action="/cms/login.php" autocomplete="off" method="post">
          <input class="user form-control" type="text" name="user_name"  placeholder="Felhasználó név">
          <input class="user form-control" type="password" name="user_password" placeholder="Jelszó">
          <button class="btn login" name="login" type="submit">Belépés</button>
          <div class="option" id="getpass"><p class="option-text"><i class="fa fa-key"></i> Jelszó emlékeztető</p></div>
        </form>



        <form id="fpass-form"  method="post">
          <input type="email" class="user form-control" name="email" placeholder="E-mail">
          <button class="btn login" id="getpass-btn" name="forgot" type="submit">Küldés</button>
         <p class="error text-center"><?php echo isset($error['email'])?  $error['email'] : ''?> </p>
       </form>


      </div>


         </div>
     </div>
 </div>
