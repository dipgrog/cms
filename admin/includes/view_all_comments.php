<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Номер</th>
			<th>Автор</th>
			<th>Комментарий</th>
			<th>Пост</th>
			<th>Почта</th>
			<th>Дата</th>
			<th>Статус</th>
			<th> </th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

		<?php 
		$query = 'SELECT * FROM comments';
		$comments = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($comments)) 
		{
			$comment_id = $row['comment_id'];
			$comment_post_id = $row['comment_post_id'];
			$comment_author = $row['comment_author'];
			$comment_status = $row['comment_status'];
			$comment_content = $row['comment_content'];
			$comment_date = $row['comment_date'];
			$comment_email = $row['comment_email'];

			$query_p = "SELECT post_title FROM posts WHERE post_id = $comment_post_id";
			$post_title_query = mysqli_query($connection, $query_p);
			while ($rr = mysqli_fetch_assoc($post_title_query)) {
				$post_t = $rr['post_title'];
			}

			?>



			<tr>
				<td> <?php echo $comment_id; ?> </td>
				<td> <?php echo $comment_author; ?> </td>
				<td> <?php echo $comment_content; ?> </td>
				<td> <a href="../post.php?p_id=<?php echo $comment_post_id; ?>"><?php echo $post_t; ?></a> </td>
				<td> <?php echo $comment_email; ?> </td>
				<td> <?php echo $comment_date; ?> </td>
				<td> <?php echo $comment_status; ?> </td>
				<td><a href="comments.php?source=status&p_id=<?php echo $comment_id; ?>">Approve</a></td>
				<td><a href="comments.php?source=status&p_id=<?php echo $comment_id; ?>">Unapprove</a></td>
				<td><a href="comments.php?delete=<?php echo $comment_id; ?>">Delete</a></td>

			</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php 
	if (isset($_GET['delete'])) {
		$del_comment_id = $_GET['delete'];
		$query = "DELETE FROM posts WHERE comment_id = {$del_comment_id}";
		$delete_post = mysqli_query($connection, $query);
		checkQuery($delete_post);
		header('Location: posts.php');
	}

	?>