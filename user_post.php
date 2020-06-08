<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/nav.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                 <?php

             if (isset($_GET['p_id'])) {
              $catch_post_id = $_GET['p_id'];

                  $the_post_user = $_GET['user'];

                 $query = "SELECT * FROM posztok WHERE post_user = '{$the_post_user}' ";
                 $select_all_post = mysqli_query($connect, $query);

                 while ($row = mysqli_fetch_assoc($select_all_post)) {
                   $post_id = $row['post_id'];
                   $post_cim = $row['post_cim'];
                   $post_user = $row['post_user'];
                   $post_date = $row['post_date'];
                   $post_img = $row['post_img'];
                   $post_tartalom = $row['post_tartalom'];
                   
                 ?>


                 <div class="section-title">
                   <h2 class="title">Szerző Posztok</h2>
                 </div>

                   <!-- Blog Post -->
                   
                   <h3 class="post-title"><a class="author" href="post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>
                   

                   <!-- Blog Post -->

                  <ul class="post-meta">

                       <li>
                         Poszt szerzője: <?php echo $post_user ?>
                       </li>


                   <li><span class="fa fa-clock-o"></span> <?php echo $post_date ?></li>
                  </ul>
                   <img class="img-fluid" src="img/<?php echo $post_img; ?>" alt="pic">
                   <hr>
                   <p><?php echo $post_tartalom ?></p>


                 <?php } }?>

      </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/side.php"; ?>
        </div>
        <!-- /.row -->
        </div>


        <?php include "includes/footer.php"; ?>
