
<!-- form edit -->
<form action="" method="post">
<div class="form-group">

 <label for="cat-title">Változtat Kategóriát</label>

 <?php
 if (isset($_GET['update'])) {
   $cat_id = escape($_GET['update']);



   $query = "SELECT * FROM kategoriak WHERE cat_id = $cat_id";
   $edit_categories = mysqli_query($connect, $query);

   while ($row = mysqli_fetch_assoc($edit_categories)) {
     $cat_id = escape($row['cat_id']);
     $cat_cim = escape($row['cat_cim']);

?>
<input class="form-control" value="<?php if(isset($cat_cim)) {echo $cat_cim;} ?>" type="text"  name="cat_cim">
<?php }} ?>

<?php

// form update
if(isset($_POST['update_cat'])){

 $u_cat_title = $_POST['cat_cim'];
 $stmt = mysqli_prepare($connect, "UPDATE kategoriak SET cat_cim = ? WHERE cat_id = ? ");
 mysqli_stmt_bind_param($stmt, 'si', $u_cat_title, $cat_id);
 mysqli_stmt_execute($stmt);


  conFirm($stmt);

  mysqli_stmt_close($stmt);
}


?>

</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_cat" value="Változtat">
</div>
</form>
