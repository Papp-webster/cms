<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top main-navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="/cms"><img src="/cms/img/logo02.png" alt="logo"></a>
    <button class="navbar-toggler" type="button">
      <i class="fa fa-bars"></i>
    </button>
    <div class="overlay d-flex d-lg-none"></div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div class="order-lg-2 d-lg-flex w-100 sidebar pb-3 pb-lg-0">
      <ul class="nav navbar-nav mr-lg-auto mb-2 mb-lg-0">
        <?php

        $query = "SELECT * FROM kategoriak";
        $select_all_cat_query = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($select_all_cat_query)) {
          $cat_cim = $row['cat_cim'];
          $cat_id = $row['cat_id'];

          $category_class = '';

          if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
            $category_class = 'active';
          }

          echo "<li class='$category_class'><a class='nav-link px-3 px-lg-2' href='/cms/category/$cat_id'>{$cat_cim}</a></li>";
        }
        ?>

        <?php if (is_admin($_SESSION['username'])) : ?>
        <li>
          <a class="nav-link px-3 px-lg-2" href="/cms/admin" target="_blank">Admin</a>
        </li>
        <?php endif; ?>

        <?php if ($_SESSION['username']) : ?>
        <li>
          <a class="nav-link px-3 px-lg-2" href="/cms/profile.php" target="_blank">Profil</a>
        </li>
        <?php endif; ?>



        <?php

        if (is_admin($_SESSION['username'])) {

          if (isset($_GET['p_id'])) {

            $the_post_id = $_GET['p_id'];

            echo "<li><a href='/cms/admin/post.php?source=edit_post&p_id={$the_post_id}' class='nav-link' target='_blank'>Edit Post</a></li>";
          }
        }

        ?>



      </ul>
      <ul class="nav navbar-nav ml-auto">

        <?php if (isset($_SESSION['user_role'])) : ?>

        <?php if (empty($_SESSION['user_image'])) : ?>
        <li>

          <img class="img-responsive rounded-circle"
            src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
            width="40" alt="default picture"></li>

        <?php else : ?>
        <li class="nav-item"><img class="img-responsive rounded-circle"
            src="/cms/img/<?php echo $_SESSION['user_image']; ?>" width="40" alt="User picture"></li>


        <?php endif; ?>
        <li class="nav-item"><span class="users">
            <strong>Üdvözöljük,</strong>
            <?php echo $_SESSION['username']; ?>
          </span></li>

        <li class="nav-item"><a class="nav-link px-3 px-lg-2" href="/cms/includes/logout.php">
            <i class="fa fa-power-off"></i>
            <strong>Kilépés</strong>
          </a></li>
        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link px-3 px-lg-2" href="/cms/login.php"><i
              class="fa fa-user-plus"></i> Bejelentkezés</a>
        </li>
        <?php endif; ?>


        <form class="form-inline d-flex px-3 px-lg-2" action="/cms/search" method="post">
          <div class="input-group icon-border">
            <input class="form-control form-control-sm  w-70" name="search" type="text" placeholder="Keresés..">
            <div class=" input-group-append">
              <button class="icon-btn" name="send"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>


      </ul>

    </div>
  </div>
</nav>




