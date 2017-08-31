<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Номер</th>
			<th>Автор</th>
			<th>Заголовок</th>
			<th>Категория</th>
			<th>Статус</th>
			<th>Изображение</th>
			<th>Тэги</th>
			<th>Комментарии</th>
			<th>Дата</th>
		</tr>
	</thead>
	<tbody>

	<?php 
		$query = 'SELECT * FROM posts';
		$posts = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($posts)) 
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
	?>

    

		<tr>
			<td> <?php echo $post_id; ?> </td>
			<td> <?php echo $post_author; ?> </td>
			<td> <?php echo $post_title; ?> </td>
            <td>
            <?php 
                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                $cat = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($cat)) {
                    $cat_title = $row['cat_title'];
                    echo  $cat_title;   
                }
            ?>
            </td>
			<td> <?php echo $post_status; ?> </td>
			<td> <img width="100" src="../images/<?php echo $post_image;?>" alt="image">  </td>
			<td> <?php echo $post_tags; ?> </td>
			<td> <?php echo $post_comment_count; ?> </td>
			<td> <?php echo $post_date; ?> </td>
			<td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id; ?>">Edit</a></td>
			<td><a href="posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>

		</tr>
	<?php } ?>
	</tbody>
</table>

<?php 
if (isset($_GET['delete'])) {
   $del_post_id = $_GET['delete'];
   $query = "DELETE FROM posts WHERE post_id = {$del_post_id}";
   $delete_post = mysqli_query($connection, $query);
   checkQuery($delete_post);
   header('Location: posts.php');
}

 ?>