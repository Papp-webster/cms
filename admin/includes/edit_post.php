<?php

if(isset($_GET['p_id'])) {
  $get_post_id = ($_GET['p_id']);
}

$query = "SELECT * FROM posztok WHERE post_id = $get_post_id";
$select_posts_by_id = mysqli_query($connect, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
  $post_id = escape($row['post_id']);
  $post_author = escape($row['post_author']);
  $post_cim = escape($row['post_cim']);
  $post_cat_id = escape($row['post_cat_id']);
  $post_status = escape($row['post_status']);
  $post_img = escape($row['post_img']);
  $post_tartalom = escape($row['post_tartalom']);
  $post_tags = escape($row['post_tags']);
  $post_com_count = escape($row['post_com_count']);
  $post_date = escape($row['post_date']);


}

if (isset($_POST['submit'])) {

  $post_author = $_POST['post_author'];
  $post_user = $_POST['post_user'];
  $post_cim = $_POST['post_cim'];
  $post_cat_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $location = "../img";
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  $post_tartalom = $_POST['post_tartalom'];
  $post_tags = $_POST['post_tags'];

  date_default_timezone_set("Europe/Budapest");
  $currentTime = time();
  $post_date = strftime("%Y.%m.%d %H:%M", $currentTime);

  move_uploaded_file($post_image_temp, "$location/$post_image" );



  if (empty($post_image)) {

    $query = "SELECT * FROM posztok WHERE post_id = $get_post_id";
    $select_image = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($select_image)) {
      $post_image  = $row['post_img'];

      }
  }

  
  $query = "UPDATE posztok SET ";
  $query .="post_cim ='{$post_cim}', ";
  $query .="post_cat_id ='{$post_cat_id}', ";
  $query .="post_date = '{$post_date}', ";
  $query .="post_user = '{$post_user}', ";
  $query .="post_author ='{$post_author}', ";
  $query .="post_status ='{$post_status}', ";
  $query .="post_tags ='{$post_tags}', ";
  $query .="post_tartalom ='{$post_tartalom}', ";
  $query .="post_img ='{$post_image}' ";
  $query .="WHERE post_id = {$get_post_id} ";

  $update_post = mysqli_query($connect, $query);

  conFirm($update_post);

echo "<p class='bg-success'>Sikeresen megváltozott a poszt!. <a href='../post.php?p_id={$get_post_id}'>View Post </a> or <a href='post.php'>Összes poszt</a></p>";



}


?>





<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_cim">Poszt cím</label>
    <input value="<?php echo $post_cim; ?>" type="text" class="form-control" name="post_cim">
  </div>

  <div class="form-group">
    <label for="category">Felhasználók:</label>
    <select name="post_user" id="post_category">

      <?php
      $users_query = "SELECT * FROM users";
      $select_users = mysqli_query($connect, $users_query);
      conFirm($select_users);

      while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = escape($row['user_id']);
        $username = escape($row['user_name']);
        echo "<option value='{$username}'>{$username}</option>";
}
      ?>
     <option></option>
    </select>

  </div>

  <div class="form-group">
    <label for="category">Kategóriák:</label>
    <select name="post_category" id="post_category">
      <?php
      $query = "SELECT * FROM kategoriak";
      $select_categories = mysqli_query($connect, $query);
      conFirm($select_categories);

      while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = escape($row['cat_id']);
        $cat_cim = escape($row['cat_cim']);

        if ($cat_id == $post_cat_id) {
          echo "<option selected value='{$cat_id}'>$cat_cim</option>";
        } else {
          echo "<option value='{$cat_id}'>$cat_cim</option>";
        }
}


      ?>

    </select>

  </div>

  <div class="form-group">
    <label for="post_author">Poszt szerző</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
  </div>

<div class="form-group">
 <select class="" name="post_status">
   <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
   <?php
  if ($post_status == 'publikált') {
      echo "<option value='draft'>draft</option>";
  }else {
      echo "<option value='publikált'>publikált</option>";

  }

   ?>
 </select>
</div>



  <div class="form-group">
    <img width="100" src="../img/<?php echo "$post_img"; ?>" alt="img">
    <br></br>
    <input  type="file" name="image">
  </div>


  <div class="form-group">
    <label for="post_tags">Poszt Tagek</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_tartalom">Poszt Tartalom</label>
    <textarea  type="text" class="form-control" name="post_tartalom" id="summernote" cols="30" rows="10"><?php echo str_replace('\r\n','</br>',$post_tartalom); ?></textarea>
  </div>


  <button type="submit" class="btn btn-primary" name="submit">Változtat</button>
</form>
