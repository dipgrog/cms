<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>UserName</th>
			
			<th>FirstName</th>
			<th>LastName</th>
			<th>Email</th>

			<th>Image</th>
			<th>Role</th>
			<!-- <th>Salt</th> -->
			<th> </th>
			<th> </th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

	<?php 
		$query = "SELECT * FROM users";
		$users = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($users)) 
		{
		$user_id = $row['user_id'];
		$user_name = $row['user_name'];
		//$user_password = $row['user_password'];
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_email = $row['user_email'];
		//$user_date = $row['user_date'];
		$user_image = $row['user_image'];
		$user_role = $row['user_role'];
		//$user_salt = $row['user_salt'];
	?>

		<tr>
			<td> <?php echo $user_id; ?> </td>
			<td> <?php echo $user_name; ?> </td>
			<td> <?php echo $user_firstname; ?> </td>
			<td> <?php echo $user_lastname; ?> </td>
			<td> <?php echo $user_email; ?> </td>
			<td> <img width="50" src="../images/<?php echo $user_image;?>" alt="image">  </td>
			<td> <?php echo $user_role; ?> </td>
			<td><a href="users.php?to_admin=<?php echo $user_id; ?>">Admin</a></td>
			<td><a href="users.php?to_sub=<?php echo $user_id; ?>">Subscriber</a></td>
			<td><a href="users.php?source=edit_user&u_id=<?php echo $user_id; ?>">Edit</a></td>
			<td><a href="users.php?delete=<?php echo $user_id; ?>">Delete</a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<?php 
if (isset($_GET['delete'])) {
   $del_user_id = $_GET['delete'];
   $query = "DELETE FROM users WHERE user_id = {$del_user_id}";
   $delete_user = mysqli_query($connection, $query);
   checkQuery($delete_user);
   header('Location: users.php');
}
 ?>

<?php 
if (isset($_GET['to_admin'])) {
	$user_id = $_GET['to_admin'];
	$query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
	$role = mysqli_query($connection, $query);
	checkQuery($role);
	header('Location: users.php');
}
?>

<?php 
if (isset($_GET['to_sub'])) {
	$user_id = $_GET['to_sub'];
	$query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";
	$role = mysqli_query($connection, $query);
	checkQuery($role);
	header('Location: users.php');
}
?>