<div class="col-md-4">
<div class="aside-widget">
  <div class="section-title">
    <h2 class="title">Legnézettebb cikkek</h2>
  </div>
  <?php
        $query = "SELECT * FROM posztok ORDER BY post_views DESC LIMIT 3";
        $select_view_post = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($select_view_post)) {
          $post_id = $row['post_id'];
          $post_cim = $row['post_cim'];
          $post_img = $row['post_img'];
          $post_user = $row['post_user'];
          $post_author = $row['post_author'];
         ?>

  <!-- post -->
  <div class="post post-widget">
    <a class="post-img" href="/cms/post.php?p_id=<?php echo $post_id; ?>">
    <img class="img-fluid" src="/cms/img/<?php echo imagePlaceholder($post_img); ?>" alt="">
    </a>

    <div class="post-body">
    <h3 class="post-title"><a class="author" href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_cim ?></a></h3>
    <ul class="post-meta">
      <li><?php if (!empty($post_user)): ?>
        Szerző: <a class="author" href="/cms/user_post.php?user=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_user ?></a>
      <?php else: ?>
          Szerző: <a class="author" href="/cms/author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"  target="_blank"><?php echo $post_author ?></a>
      <?php endif; ?></li>

    </ul>
    </div>
  </div>
<?php } ?>



</div>
<?php include "widget.php"; ?>
</div>

   <!-- Side Widget Well -->
