<style>
	.gallery { display: flex; gap: 1em; }
	.ellipsis { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 14em; display: inline-block; }
	td blockquote { color: green; margin: 1em 0; }
	td img { height: 200px; }
</style>

<table>
	<?php
		foreach ($posts as $index => $post) {

			$post_parts = explode("<POST_PART>", $post);

			echo "<tr><th>$post_parts[0] #$index</th></tr>";
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
</table>
