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
                        Категории
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">

                        <?php insert_category();?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat-title">Название категории</label>
                                <input class="form-control" type="text" name="cat_title" id="#cat-title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Добавить категорию">
                            </div>
                        </form>

                        <?php 
                        if (isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include 'includes/update_category.php';
                        }
                        ?>

                    </div>

                    <div class="col-xs-6">


                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category title</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showAllcategories();?>
                                <?php deleteCategory(); ?>
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include 'includes/admin_footer.php'; ?>



