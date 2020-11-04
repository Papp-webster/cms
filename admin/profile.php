<?php include "includes/admin_header.php" ?>

<?php
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE user_name = '{$username}' ";

  $select_user_profil = mysqli_query($connect, $query);

  while ($row = mysqli_fetch_array($select_user_profil)) {
    $user_id = escape($row['user_id']);
    $user_name = escape($row['user_name']);
    $user_password = escape($row['user_password']);
    $user_firstname = escape($row['user_firstname']);
    $user_lastname = escape($row['user_lastname']);
    $user_email = escape($row['user_email']);
    $user_image = escape($row['user_image']);

  }
}


?>

<?php
if (isset($_POST['update_user'])) {

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];


  $location = "../img";
  $user_image = $_FILES['image']['name'];
  $user_image_temp = $_FILES['image']['tmp_name'];

  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

move_uploaded_file($user_image_temp, "$location/$user_image" );

if (!empty($user_password)) {
  $query_pass = "SELECT user_password FROM users WHERE user_id = $the_user_id";
  $get_user = mysqli_query($connect, $query_pass);
  
  conFirm($get_user);
  $row = mysqli_fetch_array($get_user);
  $db_user_pass = $row['user_password'];
  
  if ($db_user_pass != $user_password) {
   $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
  }


$query = "UPDATE users SET ";
$query .="user_firstname ='{$user_firstname}', ";
$query .="user_lastname ='{$user_lastname}', ";
$query .="user_role = '{$user_role}', ";
$query .="user_image = '{$user_image}', ";
$query .="user_name ='{$user_name}', ";
$query .="user_email ='{$user_email}', ";
$query .="user_password ='{$hash_password}' ";
$query .="WHERE user_name = '{$username}' ";

$edit_query = mysqli_query($connect,$query);

conFirm($edit_query);
echo "Felhasználó változtatva! Elérhető itt:" . "<a href='users.php'> Felhasználók</a>";

}

}else {
  header("Location: index.php");
}


?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navi.php" ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Üdvözöljük az Admin panelen
                          <small><?php echo $_SESSION['username']; ?></small>
                      </h1>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="post_cim">Családi név</label>
                          <input type="text" value=" <?php echo $user_firstname; ?> "class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                          <label for="post_status">Utónév</label>
                          <input type="text" value=" <?php echo $user_lastname; ?> " class="form-control" name="user_lastname">
                        </div>

                        <div class="form-group">
                          <label for="user_img">kép feltöltése</label>
                          <input type="file" class="form-control-file" name="image">
                        </div>

                        <div class="form-group">
                          <label for="post_author">Név</label>
                          <input type="text" value=" <?php echo $user_name; ?> " class="form-control" name="user_name">
                        </div>

                      <div class="form-group">
                          <label for="post_tags">Email</label>
                          <input type="email" value=" <?php echo $user_email; ?>" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                          <label for="post_tartalom">Jelszó</label>
                          <input autocomplete="off" type="password" class="form-control" name="user_password">
                        </div>


                        <button type="submit" class="btn btn-primary" name="update_user" value="Update user">Profil változtat</button>
                      </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
