<!DOCTYPE html>
<html>
<head>
	<?php
		$id = substr($_SERVER["REQUEST_URI"], 15);

		$thread = "threads/$id";

		$meta_and_posts = explode("<META_DELIMITER>", file_get_contents($thread, false));

		$meta = explode("\n", $meta_and_posts[0]);
		$posts = explode("<POST_DELIMITER>", $meta_and_posts[1]);
	?>

	<meta charset="UTF-8">
	<title>bbwforum - <?php echo $meta[0]; ?></title>
	<link rel="stylesheet" href="shared.css">
	<style>
		td { color: black; }
	</style>
</head>

<body>

	<!-- php -S localhost:4444 -t . -->

	<table>
		<?php
			foreach ($posts as $index => $post) {

				$post_parts = explode("<POST_PART>", $post);

				echo "<tr><th>$post_parts[0] #$index</th></tr>";
				echo "<tr><td>";

				$post_lines = explode("\n", $post_parts[2]);

				foreach ($post_lines as $post_line) {
					echo "<p>$post_line</p>";
				}
				
				echo "</td></tr>";
			}
		?>
	</table>
</body>

</html>
