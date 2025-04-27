<?php
		$id = $uri[2];

		$thread = "threads/$id";

		$meta_and_posts = explode("<META_DELIMITER>", file_get_contents($thread, false));

		$meta = explode("\n", $meta_and_posts[0]);
		$posts = explode("<POST_DELIMITER>", $meta_and_posts[1]);
?>

<title>bbwforum - <?php echo $meta[0]; ?></title>

<style>
	td { color: black; }
</style>

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
