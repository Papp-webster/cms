<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <div class="section-title">
        <h2 class="title">Szerző Posztok</h2>
      </div>

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
          $post_tartalom = substr($row['post_tartalom'], 0, 400);

      ?>




          <!-- Blog Post -->

          <h3 class="post-title"><a class="author" href="post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>


          <!-- Blog Post -->

          <ul class="post-meta">

            <li>
              Poszt szerzője: <?php echo $post_user ?>
            </li>


            <li><span class="fa fa-clock-o"></span> <?php echo $post_date ?></li>
          </ul>
          <a class="img-post" href="post.php?p_id=<?php echo $post_id; ?>">
            <img class="img-fluid" src="img/<?php echo $post_img; ?>" alt="pic">
          </a>
          <hr>
          <p><?php echo $post_tartalom ?></p>
          <a class="btn comm pull-right mb-4" href="post.php?p_id=<?php echo $post_id; ?>">Tovább..</a>
          <div class="clearfix"></div>



      <?php }
      } ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/side.php"; ?>
  </div>
  <!-- /.row -->
</div>


<?php include "includes/footer.php"; ?>