
<?php 
	if (isset($_GET['p_id'])){
		$p_id = $_GET['p_id'];
	}	
		$query = "SELECT * FROM posts WHERE post_id = $p_id ";
		$post = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($post)) 
		{
			$post_id = $row['post_id'];
			$post_author = $row['post_author'];
			$post_title = $row['post_title'];
			$post_category_id = $row['post_category_id'];
			$post_status = $row['post_status'];
			$post_image = $row['post_image'];
			$post_tags = $row['post_tags'];
			$post_comment_count = $row['post_comment_count'];
			$post_date = $row['post_date'];
			$post_content = $row['post_content'];
		}
	


	if (isset($_POST['update_post'])) {
		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];
		$post_image = $_FILES['post_image']['name'];
		$post_image_tmp = $_FILES['post_image']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
		
		move_uploaded_file($post_image_tmp, "../images/$post_image");

		if (empty($post_image)) {
			$query = "SELECT * FROM posts WHERE post_id = $p_id ";
			$p_image = mysqli_query($connection, $query);
			while ($row = mysqli_fetch_array($p_image)) {
				$post_image = $row['post_image'];
			}
		}

		$query = "UPDATE posts SET ";
		$query.= "post_title = '{$post_title}', ";
		$query.= "post_category_id = '{$post_category_id}', ";
		$query.= "post_date = now(), ";
		$query.= "post_image = '{$post_image}', ";
		$query.= "post_author = '{$post_author}', ";
		$query.= "post_status = '{$post_status}', ";
		$query.= "post_tags = '{$post_tags}', ";
		$query.= "post_content = '{$post_content}' ";
		$query.= "WHERE post_id = {$post_id} ";


		$update_post = mysqli_query($connection, $query);

		checkQuery($update_post);
		header("Location: posts.php");
	}
?>

<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for='post_title'>Заголовок</label>
		<input class="form-control" type="text" name="post_title" value="<?php echo $post_title; ?>">
	</div>

	<div class="form-group">
		<label for='category_id'>Категория</label>
		<select name='post_category' id="" >
			<?php 
				$query = "SELECT * FROM categories";
				$cat = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_assoc($cat)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];
					echo "<option value='$cat_id'>{$cat_title}</option>";
				}
			 ?>

		</select>
	</div>

	<div class="form-group">
		<label for='author'>Автор</label>
		<input class="form-control" type="text" name="post_author" value="<?php echo $post_author; ?>">
	</div>

	<div class="form-group">
		<label for='status'>Статус</label>
		<input class="form-control" type="text" name="post_status" value="<?php echo $post_status; ?>">
	</div>

	<div class="form-group">
		<label for='image'>Изображение</label>
		<img width="100" src=" <?php echo "../images/$post_image";?> ">
		<input type="file" name="post_image">
	</div>

	<div class="form-group">
		<label for='tags'>Тэги</label>
		<input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags; ?>">

		<div class="form-group">
			<label for='content'></label>
			<textarea class="form-control" name="post_content" id="" cols="30" rows="10">
			<?php echo $post_content; ?>
			</textarea> 
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="update_post" value="Сохранить">
		</div>
	</div>
</form>