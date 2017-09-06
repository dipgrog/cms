
<?php 
	if (isset($_POST['create_user'])) {
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$user_email = $_POST['user_email'];
		$user_image = $_FILES['user_image']['name'];
		$user_image_tmp = $_FILES['user_image']['tmp_name'];

		if (!$user_name || !$user_password) {
			die('Введите имя пользователя и пароль');
		}

		move_uploaded_file($user_image_tmp, "../images/$user_image");

		$user_role = $_POST['user_role'];
	//	$user_salt = $_POST['user_salt'];
	
		$query = "INSERT INTO users (";
		$query .= "user_name, ";
		$query .= "user_password, ";
		$query .= "user_firstname, ";
		$query .= "user_lastname, ";
		$query .= "user_email, ";
		$query .= "user_date, ";
		$query .= "user_image, ";
		$query .= "user_role ";
		//$query .= "user_salt ";
		$query .= ") VALUES ( ";
		$query .= "'{$user_name}',  ";
		$query .= "'{$user_password}',  ";
		$query .= "'{$user_firstname}',  ";
		$query .= "'{$user_lastname}',  ";
		$query .= "'{$user_email}',  ";
		$query .= "now(),  ";
		$query .= "'{$user_image}',  ";
		$query .= "'{$user_role}'  ";
	//	$query .= "'{$user_salt}' ";
		$query .= ") ";


		$add_user = mysqli_query($connection, $query);

		checkQuery($add_user);
		//header("Location: users.php");

	}
?>


<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for='title'>Имя пользователя</label>
		<input class="form-control" type="text" name="user_name">
	</div>
	<div class="form-group">
		<label for='title'>First Name</label>
		<input class="form-control" type="text" name="user_firstname">
	</div>
	<div class="form-group">
		<label for='title'>Last Name</label>
		<input class="form-control" type="text" name="user_lastname">
	</div>

	<div class="form-group">
		<label for='title'>E-mail</label>
		<input class="form-control" type="text" name="user_email">
	</div>

	<div class="form-group">
		<label for='image'>Изображение</label>
		<input type="file" name="user_image">
	</div>

	<div class="form-group">
		<label for='title'>Роль</label>
		<select name="user_role" id="">
			<option value="subscriber">Select option</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>
<!-- 
	<div class="form-group">
		<label for='title'>Соль</label>
		<input class="form-control" type="text" name="user_salt">
	</div> -->

	<div class="form-group">
		<label for='title'>Пароль</label>
		<input class="form-control" type="password" name="user_password">
	</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="create_user" value="Добавить пользователя">
		</div>
	</div>
</form>