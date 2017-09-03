
<?php 
	if (isset($_POST['create_post'])) {
		$title = $_POST['title'];
		$category_id = $_POST['post_category'];
		$author = $_POST['author'];
		$status = $_POST['status'];

		$image = $_FILES['image']['name'];
		$image_tmp = $_FILES['image']['tmp_name'];

		$tags = $_POST['tags'];
		$content = $_POST['content'];
		$date = date('d-m-y');

		move_uploaded_file($image_tmp, "../images/$image");
	
		$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status, post_comment_count)";
		$query .="  VALUES ({$category_id}, '{$title}', '{$author}', now(), '{$image}', '{$content}', '{$tags}', '{$status}', 0) ";
		

		$add_post = mysqli_query($connection, $query);

		checkQuery($add_post);

		$post_id = mysqli_insert_id($connection);
		echo "<p class='bg-success'> Пост добавлен. <a href='../post.php?p_id=$post_id'>Посмотреть</a>
		или <a href='posts.php'>перейти к списку</a>
		</p>"; 
		// header("Location: posts.php");

	}
?>


<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for='title'>Заголовок</label>
		<input class="form-control" type="text" name="title">
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
		<input class="form-control" type="text" name="author">
	</div>

	<div class="form-group">
		<label for='status'>Статус</label>
		<select name="status" id="">
			<option value="draft">Черновик</option>
			<option value="published">Опубликовано</option>
		</select>
		<!-- <input class="form-control" type="text" > -->
	</div>

	<div class="form-group">
		<label for='image'>Изображение</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for='tags'>Тэги</label>
		<input class="form-control" type="text" name="tags">

		<div class="form-group">
			<label for='content'></label>
			<textarea class="form-control" name="content" id="" cols="30" rows="10">
			</textarea> 
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="create_post" value="Сохранить">
		</div>
	</div>
</form>