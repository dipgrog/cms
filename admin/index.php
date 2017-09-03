<?php include 'includes/admin_header.php'; ?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Administration
                        <small><?php echo $_SESSION['user_name']; ?></small>
                    </h1>
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
                                            <?php 
                                            $query = "SELECT * FROM posts";
                                            $select_posts = mysqli_query($connection, $query);
                                            $post_count = mysqli_num_rows($select_posts);
                                            ?>
                                            <div class='huge'><?php echo $post_count; ?></div>
                                            <div>Статьи</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Подробно</span>
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
                                            <?php 
                                            $query = "SELECT * FROM comments";
                                            $select_comments = mysqli_query($connection, $query);
                                            $comments_count = mysqli_num_rows($select_comments);
                                            ?>
                                           <div class='huge'><?php echo $comments_count; ?></div>
                                           <div>Комментарии</div>
                                       </div>
                                   </div>
                               </div>
                               <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Подробно</span>
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
                                            <?php 
                                            $query = "SELECT * FROM users";
                                            $select_users = mysqli_query($connection, $query);
                                            $users_count = mysqli_num_rows($select_users);
                                            ?>
                                        <div class='huge'><?php echo $users_count; ?></div>
                                        <div>Пользователи</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Подробно</span>
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
                                        <?php 
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection, $query);
                                        $categories_count = mysqli_num_rows($select_categories);
                                        ?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                        <div>Категории</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Подробно</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


            </div>
        </div>
        <!-- /.row -->


         <?php 
            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_draft_posts = mysqli_query($connection, $query);
            $post_draft_count = mysqli_num_rows($select_draft_posts);
        ?>
        <?php 
            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $select_draft_comment = mysqli_query($connection, $query);
            $draft_comment_count = mysqli_num_rows($select_draft_comment);
        ?>
        <?php 
            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $select_users = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_users);
        ?>
        <div class="row">
            <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Data', 'Count'],

                  <?php 
                  $elements_name = ['Activ posts', 'Draft posts', 'Comments' , 'Pending comments', 'Users', 'Subscribers','Categories'];
                  $elements_value = [$post_count, $post_draft_count, $comments_count, $draft_comment_count , $users_count, $subscriber_count ,$categories_count];
                  for ($i = 0; $i < 7; $i++) {
                      echo "['$elements_name[$i]', $elements_value[$i]],";
                  }
                  ?>
                  // ['Posts', 1000],
                  ]);

                var options = {
                  chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
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



<?php include 'includes/admin_footer.php'; ?>



