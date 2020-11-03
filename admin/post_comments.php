<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navi.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">
                      Üdvözöljük az Komment panelen
                      <small>Author</small>
                  </h1>

                  <?php
                  if (isset($_POST['checkBoxArray'])) {
                    foreach ($_POST['checkBoxArray'] as $postValueId) {
                    $bulk_options = $_POST['bulk_options'];

                     switch ($bulk_options) {
                       case 'elfogadva':
                         $query ="UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = '{$postValueId}' ";
                          $update_to_pub_status = mysqli_query($connect,$query);

                          confirm($update_to_pub_status);
                         break;

                         case 'elutasítva':
                           $query ="UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = '{$postValueId}' ";
                            $update_to_draft_status = mysqli_query($connect,$query);

                            confirm($update_to_draft_status);
                           break;

                           case 'delete':
                             $query ="DELETE FROM comments WHERE comment_id = {$postValueId}";
                              $update_to_delete_status = mysqli_query($connect,$query);

                              confirm($update_to_delete_status);
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
      <option>Válassz Opciót:</option>
      <option value="elfogadva">Elfogad</option>
      <option value="elutasítva">Elutasít</option>
      <option value="delete">Töröl</option>

    </select>

  </div>

  <div class="col-xs-4 button">
    <input type="submit" class="btn btn-success" name="submit" value="Elfogad">
  </div>
  <thead class="thead-dark">
    <tr class="line">
      <th><input id="selectAllBoxes" type="checkbox"></th>
      <th>#</th>
      <th>Szerző</th>
      <th>Comment</th>
      <th>Státusz</th>
      <th>Poszt</th>
      <th>Dátum</th>
      <th>Elfogad</th>
      <th>Elutasít</th>
      <th>Töröl</th>


    </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT * FROM comments WHERE comment_post_id = ". mysqli_real_escape_string($connect, $_GET['id']). " ";
    $select_comments = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($select_comments)) {
      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];
      $comment_author = $row['comment_author'];
      $comment_content = $row['comment_content'];
      $comment_status = $row['comment_status'];
      $comment_date = $row['comment_date'];

      echo "<tr>";
      ?>
<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id ?>'></td>
<?php
      echo "<td>$comment_id</td>";
      echo "<td>$comment_author</td>";
      echo "<td>$comment_content</td>";


      //$query = "SELECT * FROM kategoriak WHERE cat_id = $post_cat_id";
      //$edit_categories = mysqli_query($connect, $query);

      //while ($row = mysqli_fetch_assoc($edit_categories)) {
        //$cat_id = $row['cat_id'];
        //$cat_cim = $row['cat_cim'];


      //echo "<td>{$cat_cim}</td>";
//}


      echo "<td>$comment_status</td>";
      $query = "SELECT * FROM posztok WHERE post_id = $comment_post_id";
      $select_post_id_query = mysqli_query($connect,$query);
      while ($row = mysqli_fetch_assoc($select_post_id_query)) {
        $post_id = $row['post_id'];
        $post_cim = $row['post_cim'];
        echo "<td><a href ='../post.php?p_id=$post_id'>$post_cim</a></td>";

      }


      echo "<td>$comment_date</td>";
      echo "<td><a href='post_comments.php?elfogadva=$comment_id&id=". $_GET['id'] ."'class='btn btn-success'>Elfogad</a></td>";
      echo "<td><a href='post_comments.php?elutasítva=$comment_id&id=". $_GET['id'] ."'class='btn btn-warning'>Elutasít</a></td>";
      echo "<td><a onClick=\"javascript: return confirm('Biztos hogy törölni akarod?'); \" href='post_comments.php?delete=$comment_id&id=". $_GET['id'] ."'class='btn btn-danger'>Töröl</a></td>";
      echo "</tr>";


   }


    ?>
</tbody>
</table>
</form>
<?php

if (isset($_GET['elfogadva'])) {
  $d_comment_id = $_GET['elfogadva'];

  $query = "UPDATE comments SET comment_status = 'elfogadva' WHERE comment_id = $d_comment_id";
  $approve_query = mysqli_query($connect, $query);
 header("Location: post_comments.php?id=" . $_GET['id'] . " ");

}

if (isset($_GET['elutasítva'])) {
  $d_comment_id = $_GET['elutasítva'];

  $query = "UPDATE comments SET comment_status = 'elutasítva' WHERE comment_id = $d_comment_id";
  $unapprove_query = mysqli_query($connect, $query);
 header("Location: post_comments.php?id=" . $_GET['id'] . " ");

}


if (isset($_GET['delete'])) {
  $d_comment_id = $_GET['delete'];
  $query = "DELETE FROM comments WHERE comment_id = {$d_comment_id}";
  $delete_query = mysqli_query($connect, $query);
 header("Location: post_comments.php?id=" . $_GET['id'] . " ");

}



?>


</div>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
