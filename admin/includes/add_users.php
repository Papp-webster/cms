<?php
if (isset($_POST['create_user'])) {


  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];

  $user_role = $_POST['user_role'];
  $location = "../img";
  $user_image = $_FILES['image']['name'];
  $user_image_temp = $_FILES['image']['tmp_name'];

  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  //$post_date = date('d-m-y');

  $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
  move_uploaded_file($user_image_temp, "$location/$user_image" );

  $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_image, user_name, user_email, user_password) ";
$query .= "VALUES('{$user_firstname}', '{$user_lastname}','{$user_role}', '{$user_image}','{$user_name}', '{$user_email}', '{$user_password}')";

$create_user_query = mysqli_query($connect, $query);
conFirm($create_user_query);

echo "Új Felhasználó: " ." ". "<a href='users.php'>Felhasználók</a>";

}

?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_cim">Családi név</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="post_status">Utónév</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <select name="user_role" id="">
      <option value="subscriber">Válassz:</option>
      <option value="admin">admin</option>
      <option value="Feliratkozó">Felirtakozó</option>

    </select>

  </div>


  <div class="form-group">
    <label for="post_author">Név</label>
    <input type="text" class="form-control" name="user_name">
  </div>



  <div class="form-group">
    <label for="user_img">Poszt images</label>
    <input type="file" class="form-control-file" name="image">
  </div>


  <div class="form-group">
    <label for="post_tags">Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="post_tartalom">Jelszó</label>
    <input type="password" class="form-control" name="user_password">
  </div>


  <button type="submit" class="btn btn-primary" name="create_user" value="add_user">Közzétesz</button>
</form>
