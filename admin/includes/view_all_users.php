
<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr class="line">
      <th>#</th>
      <th>Név</th>
      <th>Családi név</th>
      <th>Utónév</th>
      <th>Email</th>
      <th>Kép</th>
      <th>Role</th>
      <th>Admin</th>
      <th>Feliratkozó</th>
      <th>Változtat</th>
      <th>Töröl</th>

      </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($select_users)) {
      $user_id = escape($row['user_id']);
      $user_name = escape($row['user_name']);
      $user_password = escape($row['user_password']);
      $user_firstname = escape($row['user_firstname']);
      $user_lastname = escape($row['user_lastname']);
      $user_email = escape($row['user_email']);
      $user_image = escape($row['user_image']);
      $user_role = escape($row['user_role']);


      echo "<tr>";
      echo "<td>$user_id</td>";
      echo "<td>$user_name</td>";
      echo "<td>$user_firstname</td>";
      echo "<td>$user_lastname</td>";

      //$query = "SELECT * FROM kategoriak WHERE cat_id = $post_cat_id";
      //$edit_categories = mysqli_query($connect, $query);

      //while ($row = mysqli_fetch_assoc($edit_categories)) {
        //$cat_id = $row['cat_id'];
        //$cat_cim = $row['cat_cim'];


      //echo "<td>{$cat_cim}</td>";
//}


      echo "<td>$user_email</td>";
      echo "<td><img src='../img/$user_image' width='100''alt='kep'></td>";
      echo "<td>$user_role</td>";
      //$query = "SELECT * FROM posztok WHERE post_id = $comment_post_id";
      //$select_post_id_query = mysqli_query($connect,$query);
      //while ($row = mysqli_fetch_assoc($select_post_id_query)) {
        //$post_id = $row['post_id'];
        //$post_cim = $row['post_cim'];
        //echo "<td><a href ='../post.php?p_id=$post_id'>$post_cim</a></td>";

      //}



      echo "<td><a href='users.php?admin=$user_id'>admin</a></td>";
      echo "<td><a href='users.php?subscriber=$user_id'>Feliraktozó</a></td>";
      echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Változtat</a></td>";
      echo "<td><a href='users.php?delete=$user_id'>Töröl</a></td>";
      echo "</tr>";


   }


    ?>
</tbody>
</table>

<?php

if (isset($_GET['admin'])) {
  $the_user_id = escape($_GET['admin']);

  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
  $admin_query = mysqli_query($connect, $query);
 header("Location: users.php");

}

if (isset($_GET['subscriber'])) {
  $sub_id = escape($_GET['subscriber']);

  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $sub_id";
  $sub_query = mysqli_query($connect, $query);
 header("Location: users.php");

}


if (isset($_GET['delete'])) {

 if (isset($_SESSION['user_role'])) {
   if ($_SESSION['user_role'] == 'admin') {

  $d_user_id = mysqli_real_escape_string($connect, $_GET['delete']);
  $query = "DELETE FROM users WHERE user_id = {$d_user_id}";
  $delete_query = mysqli_query($connect, $query);
 header("Location: users.php");
 }
}
}



?>


</div>
