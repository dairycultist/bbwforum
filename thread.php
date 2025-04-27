<style>
	.gallery { display: flex; gap: 1em; }
	.ellipsis { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 14em; display: inline-block; }
	td blockquote { color: green; margin: 1em 0; }
	td img { height: 200px; }
</style>

<h2><?php echo "$meta[0] ($meta[2])"; ?></h2>

<table>
	<?php
		foreach ($posts as $index => $post) {

			$post_parts = explode("<POST_PART>", $post);

			echo "<tr><th>" . format_date($post_parts[0]) . " #$index</th></tr>";
			echo "<tr><td>";

			$post_images = explode("\n", $post_parts[1]);

			echo "<div class='gallery'>";

			foreach ($post_images as $post_image) {

				if (!empty(trim($post_image))) {
					echo "
					<a href='$post_image'>
						<span class='ellipsis'>$post_image</span>
						<br>
						<img src='$post_image'>
					</a>
					";
				}
			}

			echo "</div>";

			$post_lines = explode("\n", $post_parts[2]);

			foreach ($post_lines as $post_line) {

				if (empty(trim($post_line))) {

				} else if ($post_line[0] == ">") {
					echo "<blockquote>$post_line</blockquote>";
				} else {
					echo "<p>$post_line</p>";
				}
			}
			
			echo "</td></tr>";
		}
	?>
	<tr>
		<th>
			<!-- https://www.w3schools.com/php/php_file_upload.asp -->
			<form action="/action_make_post.php" method="POST">
				<input type="text" name="post_id" value="<?php echo $id; ?>" style="display: none;">

				<label for="post_body">Make post:</label><br>
				<textarea id="post_body" name="post_body" rows="6" cols="80"></textarea>
				<br>
				<input type="submit" value="Post">
			</form>
		</th>
	</tr>
</table>