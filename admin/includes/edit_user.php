<?php

if (isset($_GET['edit_user'])) {
$the_user_id = $_GET['edit_user'];

$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$select_users_query = mysqli_query($connect, $query);

while ($row = mysqli_fetch_assoc($select_users_query)) {
  $user_id = escape($row['user_id']);
  $user_name = escape($row['user_name']);
  $user_password = escape($row['user_password']);
  $user_email = escape($row['user_email']);
  $user_image = escape($row['user_image']);
  $user_role = escape($row['user_role']);
}

?>

<?php

if (isset($_POST['edit_user'])) {

  $user_role = $_POST['user_role'];
  $location = "../img02";
  $user_image = $_FILES['image']['name'];
  $user_image_temp = $_FILES['image']['tmp_name'];

  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $post_date = date('d-m-y');

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
$query .="user_role = '{$user_role}', ";
$query .="user_image = '{$user_image}', ";
$query .="user_name ='{$user_name}', ";
$query .="user_email ='{$user_email}', ";
$query .="user_password ='{$hash_password}' ";
$query .="WHERE user_id = {$the_user_id} ";

$edit_query = mysqli_query($connect,$query);

conFirm($edit_query);

echo "Felhasználó változtatva! Elérhető itt:" . "<a href='users.php'> Felhasználók</a>";


}

}


} else {
  header("Location: index.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">
  
  <div class="form-group">
    <select name="user_role" id="">
      <option value="<?php echo $user_role ?>"><?php echo $user_role; ?></option>
    <?php

  if ($user_role == 'admin') {
    echo "<option value='subscriber'>Felirtakozó</option>";
  } else {
    echo "<option value='admin'>admin</option>";
  }


    ?>
</select>

  </div>

  <div class="form-group">
    <label for="user_img">kép feltöltése</label>
    <input type="file" class="form-control-file" name="image">
  </div>

  <div class="form-group">
    <label for="Name">Név</label>
    <input type="text" value="<?php echo $user_name ?>" class="form-control" name="user_name">
  </div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="post_tartalom">Jelszó</label>
    <input autocomplete="off" type="password" class="form-control" name="user_password">
  </div>


  <button type="submit" class="btn btn-primary" name="edit_user" value="add_user">Közzétesz</button>
</form>
