
<?php
if (isset($_POST['create_post'])) {
  $post_cim = $_POST['post_cim'];
  $post_author = $_POST['post_author'];
  $post_user = $_POST['post_user'];
  $post_cat_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $location = "../img";
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  //$post_com_count = 4;


  $post_tags = $_POST['post_tags'];
  $post_tartalom = $_POST['post_tartalom'];
  $post_date = date("y.m.d");


  move_uploaded_file($post_image_temp, "$location/$post_image" );



$query = "INSERT INTO posztok(post_cat_id, post_cim, post_author, post_user, post_date, post_img, post_tartalom, post_tags, post_status) ";
$query .= "VALUES('{$post_cat_id}', '{$post_cim}','{$post_author}', '{$post_user}',now(),'{$post_image}', '{$post_tartalom}', '{$post_tags}', '{$post_status}')";

$create_post_query = mysqli_query($connect, $query);
conFirm($create_post_query);
$get_post_id = mysqli_insert_id($connect);
echo "<p class='bg-success'>Sikeresen létrejött a poszt!.<a href='../post.php?p_id={$get_post_id}'>Lásd Poszt</a> or <a href='post.php'>Összes poszt</a></p>";
}

?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_cim">Poszt cím</label>
    <input type="text" class="form-control" name="post_cim">
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

        echo "<option value='{$cat_id}'>$cat_cim</option>";
}
      ?>

    </select>

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
    <label for="post_author">Poszt szerző</label>
    <input type="text" class="form-control" name="post_author">
  </div>





  <div class="form-group">
    <select name="post_status" id="">
      <option>Státusz:</option>
        <option value="publikált">publikált</option>
        <option value="draft">draft</option>
    </select>
 </div>

  <div class="form-group">
    <label for="post_img">Poszt images</label>
    <input type="file" class="form-control-file" name="image">
  </div>


  <div class="form-group">
    <label for="post_tags">Poszt Tagek</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_tartalom">Poszt Tartalom</label>
    <textarea type="text" class="form-control" name="post_tartalom" id="editor" cols="30" rows="10"></textarea>
  </div>


  <button type="submit" class="btn btn-primary" name="create_post">Közzétesz</button>
</form>
