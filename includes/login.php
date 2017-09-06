<?php //Удалить 
ini_set('display_errors',1);//Удалить 
error_reporting(E_ALL);//Удалить 
ob_start();
?> 
<?php include "db.php" ?>
<?php session_start() ?>

<?php 

if (isset($_POST['login'])) {
	
	$user_name = $_POST['user_name'];
	$user_password = $_POST['user_password'];

	$user_name = mysqli_real_escape_string($connection, $user_name);
	$user_password = mysqli_real_escape_string($connection, $user_password);
 
 	// echo $user_name;
 	// echo $user_password;

	$query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
	$select_user = mysqli_query($connection, $query);

	if (!$select_user) {
		die("Failed: - " . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_array($select_user)) {

		$db_user_id = $row['user_id'];
		$db_user_name = $row['user_name'];
		$db_user_firstname = $row['user_firstname'];
		$db_user_lastname = $row['user_lastname'];
		$db_user_password = $row['user_password'];
		$db_user_role = $row['user_role'];
	}
		$user_password = crypt($user_password, $db_user_password);

	if (($db_user_name === $user_name) && ($db_user_password === $user_password)) {
		
		$_SESSION['user_name'] = $db_user_name;
		$_SESSION['user_firstname'] = $db_user_firstname;
		$_SESSION['user_lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;

		header("Location: ../admin");
	}else{
		header("Location: ../index.php");
	}
}

 ?>