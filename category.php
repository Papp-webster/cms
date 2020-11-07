<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog  Column -->
            <div class="col-md-8">
              <div class="section-title">
                <h2 class="title">Posztok</h2>
              </div>

                 <?php

               if (isset($_GET['category'])) {
                 $post_category_id  = $_GET['category'];

                 if (is_admin($_SESSION['username'])) {
                   $stmt1 = mysqli_prepare($connect, "SELECT post_id, post_cim, post_author, post_user, post_date, post_img, post_tartalom, post_views FROM posztok WHERE post_cat_id = ?");
                 } else {
                   $stmt2 = mysqli_prepare($connect, "SELECT post_id, post_cim, post_author, post_user, post_date, post_img, post_tartalom, post_views FROM posztok WHERE post_cat_id = ? AND post_status = ? ");

                   $published ='publikált';
                 }

                if (isset($stmt1)) {
                  mysqli_stmt_bind_param($stmt1, "i", $post_category_id);
                  mysqli_stmt_execute($stmt1);

                  mysqli_stmt_bind_result($stmt1, $post_id, $post_cim, $post_author, $post_user, $post_date, $post_img, $post_tartalom, $post_views);
                  $stmt = $stmt1;

                } else {
                  mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $published);
                  mysqli_stmt_execute($stmt2);

                  mysqli_stmt_bind_result($stmt2, $post_id, $post_cim, $post_author, $post_user, $post_date, $post_img, $post_tartalom, $post_views);
                 $stmt = $stmt2;
                }



                 //if (mysqli_stmt_num_rows($stmt) < 0) {
                   //echo "<p class='show-post'>Jelenleg nincs ilyen kategoria!</p>";
                 //}
                 while (mysqli_stmt_fetch($stmt)){
                     

                   ?>



                   <!-- Blog Post -->
                   <div class="container">
                    <div class="row">
                      <div class="col-md-4">
                      <div class="post">
                      <a class="post-img" href="/cms/post.php?p_id=<?php echo $post_id; ?>">
                      <img class="img-fluid" src="/cms/img/<?php echo imagePlaceholder($post_img); ?>" alt="">
                      </a>
                      </div>
                    </div>
                    <div class="col-md-8">

                   <div class="post-body">

                      <h3 class="post-title"><a class="author" href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>
                     <ul class="post-meta">
                       <li><?php if (!empty($post_user)): ?>
                         Szerző: <a class="author" href="/cms/user_post.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_user ?></a>
                       <?php else: ?>
                           Szerző: <a class="author" href="/cms/author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_author ?></a>
                       <?php endif; ?></li>
                       <li><span class="fa fa-eye"></span> <?php echo $post_views; ?></li>
                       <li><span class="fa fa-clock-o"></span> <?php echo $post_date; ?></li>
                     </ul>

                     <p><?php echo substr($post_tartalom, 0,400); ?></p>
                     <a class="btn comm pull-right mb-4" href="/cms/post.php?p_id=<?php echo $post_id; ?>">Tovább..</a>
                   </div>
                 </div>
                 </div><!--row-->
               </div><!--container-->









                 <?php } mysqli_stmt_close($stmt); } else {

                   header("Location: index.php");
                 }?>




            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/side.php"; ?>
        </div>
        <!-- /.row -->
        </div>


        <?php include "includes/footer.php"; ?>
