<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<!-- Page Content -->


<section class="section first-section">
  <div class="container-fluid">
    <div class="col-md-12 mt-4">
      <div class="section-title">
        <h2 class="title">Legújabb posztok</h2>
      </div>
    </div>
    <?php
    $query = "SELECT * FROM posztok  ORDER BY post_id DESC LIMIT 3";
    $select_all_post = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_all_post)) {
      $post_id = $row['post_id'];
      $post_cim = $row['post_cim'];
      $post_user = $row['post_user'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_img = $row['post_img'];
      $post_tartalom = substr($row['post_tartalom'], 0, 200);
      $post_status = $row['post_status'];
      $post_views = $row['post_views'];

      if ($post_status !== 'publikált') {
        echo "<h1 class='text-center'>Jelenleg nincs POSZT!</h1>";
      } else {
    ?>

        <div class="masonry-blog clearfix">
          <div class="left-side">
            <div class="masonry-box post-media">
              <img src="img/<?php echo imagePlaceholder($post_img); ?>" alt="" class="img-fluid">
              <div class="shadoweffect">
                <div class="shadow-desc">
                  <div class="post post-thumb">
                    <?php

                    $query = "SELECT * FROM kategoriak WHERE cat_id = $post_id";
                    $select_all_cat_side = mysqli_query($connect, $query);

                    while ($row = mysqli_fetch_assoc($select_all_cat_side)) {
                      $cat_cim = $row['cat_cim'];
                      $post_id = $row['cat_id'];
                    } ?>

                    <h3 class="post-title title-lg"><a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>
                    <ul class="post-meta">
                      <li><?php if (!empty($post_user)) : ?>
                          <a href="/cms/user_post.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>" target="_blank"><?php echo $post_user ?></a>
                        <?php elseif (!empty($post_author)) : ?>
                          <a href="/cms/author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>" target="_blank"><?php echo $post_author ?></a>
                        <?php endif; ?></li>
                      <li><?php echo $post_date; ?></li>
                    </ul>
                  </div><!-- end meta -->
                </div><!-- end shadow-desc -->
              </div><!-- end shadow -->
            </div><!-- end post-media -->
          </div><!-- end left-side -->
      <?php }
    } ?>
        </div>
  </div>
</section>

<!-- Page Content -->
<div class="container">

  <div class="row">


    <!-- Blog  Column -->
    <div class="col-md-8">
      <div class="section-title">
        <h2 class="title">Cikkek</h2>
      </div>
      <?php


      $post_query_count = "SELECT * FROM posztok WHERE post_status = 'publikált'";
      $find_count = mysqli_query($connect, $post_query_count);
      $count = mysqli_num_rows($find_count);

      if ($count < 1) {
        echo "<p class='show-post'>Jelenleg nincs POSZT!</p>";
      } else {

        $rowperpage = 3;

        // counting total number of posts
        $allcount_query = "SELECT count(*) as allcount FROM posztok";
        $allcount_result = mysqli_query($connect, $allcount_query);
        $allcount_fetch = mysqli_fetch_array($allcount_result);
        $allcount = $allcount_fetch['allcount'];


        $query = "SELECT * FROM posztok ORDER BY post_id asc limit 0,$rowperpage";
        $select_all_post = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($select_all_post)) {
          $post_id = $row['post_id'];
          $post_cim = $row['post_cim'];
          $post_user = $row['post_user'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_img = $row['post_img'];
          $post_tartalom = substr($row['post_tartalom'], 0, 300);
          $post_status = $row['post_status'];
          $post_views = $row['post_views'];

      ?>

          <!-- Blog Post -->

          <!-- row -->
          <div class="load" id="post_<?php echo $post_id; ?>">
            <div class="container">


              <div class="row">



                <div class="col-md-4">
                  <div class="post">
                    <a class="post-img" href="post.php?p_id=<?php echo $post_id; ?>">
                      <img class="img-fluid" src="img/<?php echo imagePlaceholder($post_img); ?>" alt="">
                    </a>
                  </div>
                </div>
                <!-- post -->
                <div class="col-md-8">
                  <div class="post-body">
                    <h3 class="post-title"><a class="author" href="post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>
                    <ul class="post-meta">
                      <li><?php if (!empty($post_user)) : ?>
                          Szerző: <a class="author" href="/cms/user_post.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>" target="_blank"><?php echo $post_user ?></a>
                        <?php else : ?>
                          Szerző: <a class="author" href="/cms/author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>" target="_blank"><?php echo $post_author ?></a>
                        <?php endif; ?></li>
                      <li><span class="fa fa-eye"></span> <?php echo $post_views; ?></li>
                      <li><span class="fa fa-clock-o"></span> <?php echo $post_date; ?></li>
                    </ul>
                    <p class="mb-4"><?php echo $post_tartalom ?></p>
                    <a class="btn comm mb-4" href="post.php?p_id=<?php echo $post_id; ?>">Tovább olvasom..</a>
                  </div>

                </div>

              </div>
            </div>

          </div>
          <!-- /post -->





      <?php }
      } ?>


      <!-- Pager -->
      <div class="row">
        <div class="col-md-12">
          <div class="section-row loadmore text-center">
            <a id="btn-load" type="button" name="button">Még több poszt..</a>
          </div>
          <input type="hidden" id="row" value="0">
          <input type="hidden" id="all" value="<?php echo $allcount; ?>">

        </div><!-- end col -->
      </div><!-- end row -->


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/side.php"; ?>
  </div>
  <!-- /.row -->
</div>



<?php include "includes/footer.php"; ?>