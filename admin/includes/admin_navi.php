<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="loader">
    <div class="loader-img"></div>
  </div>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
      <li> <a href="/cms" target="_blank">Home</a> </li>
           <li> <a href="index.php">Felhasználók online: <span class="usersonline"></span></a> </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
              <?php
             if (isset($_SESSION['username'])) {
               echo $_SESSION['username'];
             }

             ?> <i class="fa fa-fw fa-chevron-down"></i></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
              <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Kilépés</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Saját adatok</a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts"></i><i class="fa fa-file-text fa-1x"></i> Posztok <i class="fa fa-fw fa-chevron-down"></i></a>
                <ul id="posts" class="collapse">
                    <li>
                        <a href="./post.php">Összes Poszt</a>
                    </li>
                    <li>
                        <a href="post.php?source=add_post">Új poszt</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categories.php"><i class="fa fa-list fa-1x"></i> Kategóriák</a>
            </li>

            <li>
                <a href="comments.php"><i class="fa fa-comments fa-1x"></i> Kommentek</a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-user fa-1x"></i> Felhasználók <i class="fa fa-fw fa-chevron-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php">Összes Felhasználó</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_users">Új Felhasználók</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profil</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
