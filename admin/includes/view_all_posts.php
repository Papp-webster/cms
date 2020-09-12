<?php

if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $postValueId) {
  $bulk_options = $_POST['bulk_options'];

   switch ($bulk_options) {
     case 'publikált':
       $query ="UPDATE posztok SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
        $update_to_pub_status = mysqli_query($connect,$query);

        confirm($update_to_pub_status);


       break;

       case 'draft':
         $query ="UPDATE posztok SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
          $update_to_draft_status = mysqli_query($connect,$query);

          confirm($update_to_draft_status);
         break;

         case 'delete':
           $query ="DELETE FROM posztok WHERE post_id = {$postValueId}";
            $update_to_delete_status = mysqli_query($connect,$query);

            confirm($update_to_delete_status);
           break;

           case 'clone':
           $query = "SELECT * FROM posztok WHERE post_id = '{$postValueId}' ";
           $select_posts = mysqli_query($connect, $query);

           while ($row = mysqli_fetch_array($select_posts)) {
            $post_cat_id = escape($row['post_cat_id']);
             $post_cim = escape($row['post_cim']);
             $post_author = escape($row['post_author']);
             $post_user = escape($row['post_user']);
             $post_date = escape($row['post_date']);
             $post_img = escape($row['post_img']);
             $post_tartalom = escape($row['post_tartalom']);
             $post_tags = escape($row['post_tags']);
             $post_status = escape($row['post_status']);

             if (empty($post_tags) && empty($post_author) && empty($post_user) && empty($post_cim)) {
               $post_tags = "*nincs tag";
               $post_author = "*nincs szerző";
               $post_user = "*nincs szerző";
               $post_cim = "*nincs cím";

             }

            }

           $query = "INSERT INTO posztok(post_cat_id, post_cim, post_author, post_user, post_date, post_img, post_tartalom, post_tags, post_status) ";
           $query .= "VALUES({$post_cat_id}, '{$post_cim}', '{$post_author}','{$post_user}','{$post_date}','{$post_img}', '{$post_tartalom}', '{$post_tags}', '{$post_status}')";
           $copy_query = mysqli_query($connect, $query);
           confirm($copy_query);
           break;
     }

  }

}


?>




<form class="" action="" method="post">

<div class="table-responsive">
<table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-4">
      <select class="form-control" name="bulk_options" id="bulk">
        <option value="">Válassz Opciót:</option>
        <option value="publikált">Publikál</option>
        <option value="draft">Draft</option>
        <option value="delete">Töröl</option>
        <option value="clone">Klónoz</option>
      </select>

    </div>

    <div class="col-xs-4 button">
      <input type="submit" class="btn btn-success" name="submit" value="Elfogad">
       <a class="btn btn-primary" href="post.php?source=add_post">Hozzáad</a>
    </div>





  <thead class="thead-dark">
    <tr class="line">
      <th><input id="selectAllBoxes" type="checkbox"></th>
      <th>#</th>
      <th>Szerzők</th>
      <th>Cím</th>
      <th>Kategória</th>
      <th>Státusz</th>
      <th>Képek</th>
      <th>Tagek</th>
      <th>Kommentek</th>
      <th>Nézettség</th>
      <th>Dátum</th>
      <th>Posztok</th>
      <th>Változtat</th>
      <th>Töröl</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT posztok.post_id, posztok.post_author, posztok.post_user, posztok.post_cim, posztok.post_cat_id,posztok.post_status, posztok.post_img, ";
    $query .= "posztok.post_tags, posztok.post_com_count, posztok.post_date, posztok.post_views, kategoriak.cat_id, kategoriak.cat_cim ";
    $query .= "FROM posztok ";
    $query .= " LEFT JOIN kategoriak ON posztok.post_cat_id = kategoriak.cat_id ";
    $query .= "ORDER BY posztok.post_id DESC ";
    $select_posts = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($select_posts)) {
      $post_id = escape($row['post_id']);
      $post_author = escape($row['post_author']);
      $post_user = escape($row['post_user']);
      $post_cim = escape($row['post_cim']);
      $post_cat_id = escape($row['post_cat_id']);
      $post_status = escape($row['post_status']);
      $post_img = escape($row['post_img']);
      $post_tags = escape($row['post_tags']);
      $post_com_count = escape($row['post_com_count']);
      $post_views = escape($row['post_views']);
      $post_date = escape($row['post_date']);
      $cat_cim = escape($row['cat_cim']);
      
      echo "<tr>";

      if (empty($post_tags) && empty($post_author) && empty($post_user) && empty($post_cim)) {
        $post_tags = "<span class='postview'>*nincs tag</span>";
        $post_author = "<span class='postview'>*nincs szerző</span>";
        $post_user = "<span class='postview'>*nincs szerző</span>";
        $post_cim = "<span class='postview'>*nincs cím</span>";

      }


    ?>

      <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

      <?php
      echo "<td>$post_id</td>";
       if (!empty($post_author)) {
           echo "<td>$post_author</td>";
       }else if(!empty($post_user)){
         echo "<td>$post_user</td>";
       }


      echo "<td>$post_cim</td>";


      echo "<td>{$cat_cim}</td>";


      echo "<td>$post_status</td>";
      echo "<td><img src='../img/$post_img' width='100''alt='kep'></td>";
      echo "<td>$post_tags</td>";

      $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
      $send_comment = mysqli_query($connect, $query);
      $row = mysqli_fetch_array($send_comment);
      $comment_id = escape($row['comment_id']);
      $comm_count = mysqli_num_rows($send_comment);

      echo "<td><a class ='numb' href ='post_comments.php?id=$post_id'>$comm_count</a></td>";
      echo "<td> <a class ='numb' href='post.php?reset={$post_id}'>{$post_views}</a></td>";
      echo "<td>$post_date</td>";
      echo "<td><a href='../post.php?p_id={$post_id}' target ='_blank' class='btn btn-info'>Mutasd</a></td>";
      echo "<td><a href='post.php?source=edit_post&p_id={$post_id}' class='btn btn-primary'>Változtat</a></td>";
      ?>

      <form method="post">

        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
      <?php

      echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Töröl'></td>";
      ?>
      </form>

      <?php
      //echo "<td><a onClick=\"javascript: return confirm('Biztos hogy törölni akarod?'); \" href='post.php?delete={$post_id}'>Töröl</a></td>";


      echo "</tr>";



   }


    ?>
</tbody>
</table>

</form>


<?php
if (isset($_POST['delete'])) {
  if (isset($_SESSION['user_role'])) {
  if ($_SESSION['user_role'] == 'admin') {
  $d_post_id = escape($_POST['post_id']);
  $query = "DELETE FROM posztok WHERE post_id = {$d_post_id}";
  $delete_query = mysqli_query($connect, $query);
  header("Location: post.php");
   }
  }
}

if (isset($_GET['reset'])) {
  $d_post_id = escape($connect, $_GET['reset']);
  $query = "UPDATE posztok SET post_views = 0 WHERE post_id =" . mysqli_real_escape_string($connect, $_GET['reset']) . " ";
  $reset_query = mysqli_query($connect, $query);
  header("Location: post.php");

}



?>


</div>
