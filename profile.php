<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<?php

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE user_name = '{$username}' ";
$select_users_query = mysqli_query($connect, $query);

while ($row = mysqli_fetch_assoc($select_users_query)) {
  $user_id = escape($row['user_id']);
  $user_name = escape($row['user_name']);
  $user_password = escape($row['user_password']);
  $user_firstname = escape($row['user_firstname']);
  $user_lastname = escape($row['user_lastname']);
  $user_email = escape($row['user_email']);
  $user_image = escape($row['user_image']);
  $user_role = escape($row['user_role']);
}

?>

<?php

if (isset($_POST['edit_user'])) {

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];

  $user_role = $_POST['user_role'];
  $location = "../img";
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
$query .="user_firstname ='{$user_firstname}', ";
$query .="user_lastname ='{$user_lastname}', ";
$query .="user_role = '{$user_role}', ";
$query .="user_image = '{$user_image}', ";
$query .="user_name ='{$user_name}', ";
$query .="user_email ='{$user_email}', ";
$query .="user_password ='{$hash_password}' ";
$query .="WHERE user_id = {$the_user_id} ";

$edit_query = mysqli_query($connect,$query);

conFirm($edit_query);

echo "<span class='badge badge-info'>Felhasználó változtatva!<span>";


}

}


} else {
  header("Location: index.php");
}

?>

<div class="container mt-4">
  <div class="row flex-lg-nowrap">
    <div class="col">
      <div class="row">
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <div class="e-profile">
                <div class="row">
                  <div class="col-12 col-sm-auto mb-3">
                    <div class="mx-auto" style="width: 140px;">
                      <div class="d-flex justify-content-center align-items-center rounded">
                      <img src="img/<?php echo $user_image ?>" width="150" alt="felhasználó képe">
                      </div>
                    </div>
                  </div>
                  <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Üdvözöljük, <?php echo strtoupper(get_user_name()); ?>
                      </h4>
                      <div class="mt-2">
                        <div class="form-group">
                          <label for="user_img">Kép feltöltése</label>
                          <input type="file" class="form-control-file" name="image">
                        </div>
                      </div>
                    </div>
                    <div class="text-center text-sm-right">
                      <span class="badge badge-secondary"><?php echo $user_role ?></span>
                    </div>
                  </div>
                </div>
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="" class="active nav-link">Profil adatok</a></li>
                </ul>
                <div class="tab-content pt-3">
                  <div class="tab-pane active">
                    <form class="form" novalidate="">
                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="Name">Név</label>
                                <input type="text" value="<?php echo $user_name ?>" class="form-control"
                                  name="user_name">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $user_email ?>" class="form-control"
                                  name="user_email">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                          <div class="mb-2"><b>Jelszó változtatás:</b></div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="email">Jelszó</label>
                                <input autocomplete="off" type="password" class="form-control" name="user_password">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="pass">Jelszó újra</label>
                                <input class="form-control" type="password" placeholder="••••••"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col d-flex justify-content-end">
                          <button class="btn btn-primary" type="submit" name="edit_user"
                            value="add_user">Mentés</button>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>