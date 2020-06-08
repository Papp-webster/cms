<?php include "includes/admin_header.php" ?>

<?php
if (!is_admin($_SESSION['username'])) {

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

                        <div class="col-xs-6">
                          <?php insert_categories(); ?>

                          <!-- form add -->
                        <form class="" action="categories.php" method="post">
                           <div class="form-group">
                             <label for="cat-title">Hozzáad Kategóriát</label>
                           <input type="text" class="form-control" name="cat_cim">
                           </div>
                           <div class="form-group">
                           <input class="btn btn-primary" type="submit" name="submit" value="Hozzáad">
                           </div>
                          </form>

                              <?php // UPDATE
                              if (isset($_GET['update'])) {
                                $cat_id = $_GET['update'];
                                include "includes/update_cat.php";
                              }

                              ?>
                        </div><!--add category form -->
                   <div class="col-xs-6">
                     <div class="table-responsive">
                     <table class="table table-bordered table-hover">
                       <thead class="thead-dark">
                         <tr class="line">
                           <th>#</th>
                           <th>Kategória cím</th>
                         </tr>
                       </thead>
                       <tbody>
                          <!-- find categories -->
                           <?php findAllcategories();?>
                            <!-- delete categories -->
                           <?php deleteCategories();?>

                       </tbody>
                     </table>
                   </div>
                            </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
