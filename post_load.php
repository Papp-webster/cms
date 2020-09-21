<?php include "includes/header.php"; ?>

<?php
$row = $_POST['row'];
$rowperpage = 3;
// selecting posts
$query = 'SELECT * FROM posztok limit '.$row.','.$rowperpage;
$result = mysqli_query($connect,$query);

while ($row = mysqli_fetch_assoc($result)) {
  $post_id = $row['post_id'];
  $post_cim = $row['post_cim'];
  $post_user = $row['post_user'];
  $post_author = $row['post_author'];
  $post_date = $row['post_date'];
  $post_img = $row['post_img'];
  $post_tartalom = substr($row['post_tartalom'], 0,200);
  $post_status = $row['post_status'];
  $post_views = $row['post_views'];
  
   ?>

<div class="load" id="post_<?php echo $post_id; ?>">
<div class="container">


<div class="row">



  <div class="col-md-4">
  <div class="post">
  <a class="post-img" href="post.php?p_id=<?php echo $post_id; ?>">
  <img class="img-fluid" src="/cms/img/<?php echo imagePlaceholder($post_img); ?>" alt="">
  </a>
  </div>
</div>
    <!-- post -->
    <div class="col-md-8">
      <div class="post-body">
         <h3 class="post-title"><a class="author" href="post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>
        <ul class="post-meta">
          <li><?php if (!empty($post_user)): ?>
            Szerző: <a class="author" href="/cms/user_post.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_user ?></a>
          <?php else: ?>
              Szerző: <a class="author" href="/cms/author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_author ?></a>
          <?php endif; ?></li>
          <li><span class="fa fa-eye"></span> <?php echo $post_views; ?></li>
          <li><span class="fa fa-clock-o"></span> <?php echo $post_date; ?></li>
        </ul>
        <p><?php echo $post_tartalom ?></p>

      </div>

    </div>

  </div>
    </div>
          </div>

  <?php } ?>
