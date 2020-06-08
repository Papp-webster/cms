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


                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                   <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                       <div class='huge'><?php echo $post_counts = recordCount('posztok'); ?></div>

                                        <div>Posztok</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./post.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Megnéz</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                       <div class="huge"><?php echo $comment_counts = recordCount('comments'); ?></div>

                                      <div>Kommentek</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Megnéz</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">


                                       <div class="huge"><?php echo $users_counts = recordCount('users'); ?></div>

                                        <div> Felhasználók</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Megnéz</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                         <div class="huge"><?php echo $cat_counts = recordCount('kategoriak'); ?></div>

                                         <div>Kategóriák</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Megnéz</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!-- /.row -->

              <?php

              $post_public_counts = checkStatus('posztok','post_status','publikált');


              $post_draft_counts = checkStatus('posztok','post_status','draft');


              $comm_elut_counts = checkStatus('comments','comment_status','elutasítva');


              $user_felirat_counts = checkUserRole('users','user_role','subscriber');

              ?>


                  <div class="row">

                    <script type="text/javascript">
                   google.charts.load('current', {'packages':['bar']});
               google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dátum', 'Eredmény'],
              <?php
           $elements_text = ['Összes poszt','Aktív Posztok','Elutasított Posztok','Kommentek','Elutasított kommentek', 'Felhasználók','Feliratkozók', 'Kategóriák'];
           $elements_count = [$post_counts,$post_public_counts, $post_draft_counts, $comment_counts,$comm_elut_counts, $users_counts,$user_felirat_counts, $cat_counts ];

           for ($i=0; $i < 8; $i++) {
             echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
           }

              ?>

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                      <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


                  </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
      </div>
<?php include "includes/admin_footer.php" ?>
