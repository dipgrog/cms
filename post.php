<?php include 'includes/db.php' ?>
<?php include 'includes/header.php' ?>

<!-- Navigation -->    
<?php include 'includes/navigation.php' ?>
<!-- Page Content -->

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

            <?php 
                if (isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                }
              
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $post = mysqli_query($connection, $query);
                    //checkQuery($post);
                    while ($row = mysqli_fetch_assoc($post)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    }
            ?>


                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"> <?php echo $post_date; ?></span> </p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
              <!--   <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p> -->
                <p><?php echo $post_content; ?></p>

                <hr>

                <!-- Blog Comments -->
                <?php 
                    if (isset($_POST['create_comment'])) {
                        
                        $post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];


                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                        $query  = "INSERT INTO comments (";
                        $query .= "comment_post_id, ";
                        $query .= "comment_author, ";
                        $query .= "comment_email, ";
                        $query .= "comment_date, ";
                        $query .= "comment_status, ";
                        $query .= "comment_content ";
                        $query .= ") VALUES (";
                        $query .= " {$post_id}, ";
                        $query .= "'{$comment_author}', ";
                        $query .= "'{$comment_email}', ";
                        $query .= "now(), ";
                        $query .= "'unproved', ";
                        $query .= "'{$comment_content}' ";
                        $query .= ")";

                        $comment_insert = mysqli_query($connection, $query);
                        //header("");

                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                        $count = mysqli_query($connection, $query);

                        }else{
                            echo "<script>alert('Все поля должны быть заполнены')</script>";
                        }

                    }
                 ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Оставить комментарий:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="Author">Name</label>
                            <input type="text" name="comment_author" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="comment_email"  class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="Comment">Ваш комментарий</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Отправить</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                $query  = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";

                $comments = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($comments)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                ?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $comment_content;?>
                    </div>
                </div>

            <?php } ?>

                <!-- Comment -->

            </div>

          

        <hr>

        <!-- Blog Sidebar Widgets Column -->

        <?php include 'includes/sidebar.php'?>

    </div>
    <!-- /.row -->

    <hr>
    <?php include 'includes/footer.php'?>