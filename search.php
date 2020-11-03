<?php include "includes/header.php"; ?>

<!-- navigation -->
<?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
              <div class="section-title">
                <h2 class="title">Talált posztok:</h2>
              </div>
              <?php

              if (isset($_POST['send'])) {

              $search = $_POST['search'];

              $query = "SELECT * FROM posztok WHERE post_tags LIKE '%$search%' OR post_cim LIKE '%$search%' OR post_tartalom LIKE '%$search%'";
              $search_query = mysqli_query($connect, $query);

              if (!$search_query) {
                die('Az adatbázis kapcsolat hibás! <br>' . mysqli_error($connect));
              }

            $search_count = mysqli_num_rows($search_query);
            if ($search_count == 0) {
              echo "<p class='show-post'>Nincs ilyen poszt!</p>";
            } else {

                while ($row = mysqli_fetch_assoc($search_query)) {
                $post_id = $row['post_id'];
                $post_cim = $row['post_cim'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_views = $row['post_views'];
                $post_img = $row['post_img'];
                $post_tartalom = substr($row['post_tartalom'], 0,400);
                $post_tags = $row['post_tags'];
                
          ?>




                <!-- Blog Post -->
                <h2>
                    <a class="author" href="/cms/post/<?php echo $post_id;?>"><?php echo $post_cim ?></a>
                </h2>
                <ul class="post-meta">
                <li><?php if (!empty($post_user)): ?>
                    Szerző: <a class="author" href="/cms/user_post.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_user ?></a>
                  <?php elseif(!empty($post_author)): ?>
                      Szerző: <a class="author" href="/cms/author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_author ?></a>
                  <?php endif; ?></li>

                <li><span class="fa fa-clock-o"></span> <?php echo $post_date ?></li>
                <li><span class="fa fa-eye"></span> <?php echo $post_views; ?></li>
              </ul>
                <img class="img-fluid" src="/cms/img/<?php echo $post_img; ?>" alt="">
                <div class="content-box">
                <p><?php echo $post_tartalom ?></p>

              </div>


                <hr>
         <?php }
            }
              }
        ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/side.php"; ?>
        </div>
        <!-- /.row -->
      </div>


        <?php include "includes/footer.php"; ?>
