<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


<?php 
if (isset($_POST['submit'])) {
   $username = $_POST['username'];
   $email    = $_POST['email'];
   $password = $_POST['password'];

   if (!empty($username) && !empty($email) && !empty($password)) {
             
       $username = mysqli_real_escape_string($connection, $username);
       $email    = mysqli_real_escape_string($connection, $email);
       $password = mysqli_real_escape_string($connection, $password);



       $query = "SELECT user_salt FROM users";
       $salt_query = mysqli_query($connection, $query);

       if (!$salt_query) {
           die('Failed' . mysql_error($connection));
       }

       $row = mysqli_fetch_array($salt_query);
       $salt = $row['user_salt'];

       echo $salt;

       $password = crypt($password, $salt); //##########################################
       echo "<br>";
       echo $password;

       $query  = "INSERT INTO users (";
       $query .= "user_name, ";
       $query .= "user_email, ";
       $query .= "user_role, ";
       $query .= "user_password ";
       $query .= ") VALUES ( ";
       $query .= "'{$username}', ";
       $query .= "'{$email}', ";
       $query .= "'subscriber', ";
       $query .= "'{$password}' ";
       $query .= ") ";

       $register_user = mysqli_query($connection, $query);
       if (!$register_user) {
           die('Failed ' . mysql_error($connection));
       }

       $message = "Вы зарегистрированы";
    }else{
        $message = "Все поля обязательны";
    }
}
?>



    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"> <?php if (isset($message)) echo $message; ?> </h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>