<style>
	.gallery { display: flex; gap: 1em; }
	.ellipsis { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 140px; display: inline-block; }
	td blockquote { color: green; margin: 1em 0; }

	tr + tr td { border-top: 1px solid #ddd0d0; }

	.smallimage { max-width: 140px; max-height: 140px; }
	.bigimage { display: none; }
	a:hover .bigimage { display: block; z-index: 999; position: fixed; height: 90%; top: 50%; right: 2em; transform: translateY(-50%); pointer-events: none; }
</style>

<h2><?php echo "$meta[0] ($meta[1])"; ?></h2>
<p>
	Posts:
	<strong><?php echo "$meta[2]"; ?></strong>
	| Images:
	<strong><?php echo "$meta[3]"; ?></strong>
</p>

<table>
	<?php
		foreach ($posts as $index => $post) {

			$post_parts = explode("<POST_PART>", $post);

			echo "<tr id='$index'><td>";

			echo "<div style='font-size: smaller; color: grey;'>#$index <div style='float: right;'>( <a href='/action_report.php/?thread=$id&post=$index'>Report</a> ) " . format_date($post_parts[0]) . "</div></div>";

			$post_images = explode("\n", $post_parts[1]);

			echo "<div class='gallery'>";

			foreach ($post_images as $post_image) {

				if (!empty(trim($post_image))) {
					echo "
					<a href='$post_image' target='_blank'>
						<span class='ellipsis'>$post_image</span>
						<br>
						<img src='$post_image' class='smallimage'>
						<img src='$post_image' class='bigimage'>
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

					echo "<p>";

					// must get anchor tags to other posts
					// only allow anchor tags when they're less than the current post ID
					$a_matches_count = preg_match_all("/#(?<id>[0-9]+)/", $post_line, $a_matches, PREG_PATTERN_ORDER);
					$a_split = preg_split("/#[0-9]+/", $post_line);

					for ($i = 0; $i < $a_matches_count; $i++) {
						echo $a_split[$i];

						if ($a_matches['id'][$i] < $index) {
							echo "<a href='#" . $a_matches['id'][$i] . "'>#" . $a_matches['id'][$i] . "</a>";
						} else {
							echo "#" . $a_matches['id'][$i];
						}
					}

					echo $a_split[$a_matches_count];

					echo "</p>";
				}
			}
			
			echo "</td></tr>";
		}
	?>
</table>

<!-- https://www.w3schools.com/php/php_file_upload.asp -->
<form action="/action_make_post.php" method="POST">
	<input type="text" name="post_id" value="<?php echo $id; ?>" style="display: none;">

	<label for="post_body">Make post:</label><br>
	<textarea id="post_body" name="post_body" rows="6" cols="80"></textarea>
	<br>
	<input type="submit" value="Post">
</form>