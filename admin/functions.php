<?php 

function checkQuery($query){
	global $connection;
	if (!$query) {
			die('Failed'. mysqli_error($connection));
		}
}

function insert_category(){

	global $connection;
	if (isset($_POST['submit']))
	{
		$cat_title = $_POST['cat_title'];
		if ($cat_title == '' || empty($cat_title))
		{
			echo "<h2>Введите название категории</h2>";
		}
		else
		{
			$query = "INSERT INTO categories (cat_title) VALUE ('{$cat_title}') ";

			$add_category = mysqli_query($connection, $query);

			checkQuery($add_category);
		}
	}
}




function showAllcategories(){
	global $connection;
	$query = 'SELECT * FROM categories';
	$categories = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($categories)) 
	{
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
		echo "<tr>";
	}
}

function deleteCategory(){
	global $connection;
	if (isset($_GET['delete'])) 
	{
		$del_cat_id = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
		$delete = mysqli_query($connection, $query);
		header("Location: categories.php");
		checkQuery($delete);
	}
}



?>