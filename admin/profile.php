<?php include 'includes/admin_header.php'; ?>
<?php 
if (isset($_SESSION['user_name'])) {
    
    $user_name = $_SESSION['user_name'];

    $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
    $select_user = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user)) {

        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
    }



}



if (isset($_POST['edit_user'])) {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];


        $user_role = $_POST['user_role'];
    //  $user_salt = $_POST['user_salt'];

        move_uploaded_file($user_image_tmp, "../images/$user_image");

        if (empty($user_image)) {
            $query = "SELECT * FROM users WHERE user_id = $user_id ";
            $user_image_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($user_image_query)) {
                $user_image = $row['user_image'];
            }
        }

        $query = "UPDATE users SET ";
        $query.= "user_name = '{$user_name}', ";
        $query.= "user_firstname = '{$user_firstname}', ";
        $query.= "user_lastname = '{$user_lastname}', ";
        $query.= "user_image = '{$user_image}', ";
        $query.= "user_role = '{$user_role}', ";
        $query.= "user_password = '{$user_password}', ";
        $query.= "user_email = '{$user_email}' ";
        $query.= "WHERE user_id = {$user_id} ";


        if (!$user_name || !$user_password) {
            die('Введите имя пользователя и пароль');
        }

        $update_user = mysqli_query($connection, $query);

        checkQuery($update_user);
        header("Location: users.php");
    }
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Профиль
                        <small><?php echo $_SESSION['user_name']; ?></small>
                    </h1>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for='title'>Имя пользователя</label>
                            <input class="form-control" type="text" name="user_name" value="<?php echo $user_name; ?> ">
                        </div>
                        <div class="form-group">
                            <label for='title'>First Name</label>
                            <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname; ?> ">
                        </div>
                        <div class="form-group">
                            <label for='title'>Last Name</label>
                            <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname; ?> ">
                        </div>

                        <div class="form-group">
                            <label for='title'>E-mail</label>
                            <input class="form-control" type="text" name="user_email" value="<?php echo $user_email; ?> ">
                        </div>

                        <div class="form-group">
                            <!-- <label for='image'>Изображение</label> -->
                            <img width="50" src="../images/<?php echo $user_image;?>" alt="image">
                            <input type="file" name="user_image" value="<?php echo $user_image; ?> ">
                        </div>

                        <div class="form-group">
                            <!-- <label for='title'>Роль</label> -->
                            <select name="user_role" id="">
                                <option value='<?php echo $user_role; ?>'> <?php echo $user_role; ?> </option>
                                <?php 
                                if ($user_role == 'admin') {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                }else{
                                    echo "<option value='admin'>Admin</option>";
                                }


                                ?>
                            </select>
                        </div>
<!-- 
    <div class="form-group">
        <label for='title'>Соль</label>
        <input class="form-control" type="text" name="user_salt">
    </div> -->

    <div class="form-group">
        <label for='title'>Пароль</label>
        <input class="form-control" type="password" name="user_password" value="<?php echo $user_name; ?>" >
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Обновить">
    </div>
</div>
</form>





</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>



