<table>
	<?php
		foreach ($posts as $index => $post) {

			$post_parts = explode("<POST_PART>", $post);

			echo "<tr><th>$post_parts[0] #$index</th></tr>";
			echo "<tr><td>";

			$post_lines = explode("\n", $post_parts[2]);

			foreach ($post_lines as $post_line) {

				if (empty($post_line)) {

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
