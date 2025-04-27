<style>
	td { color: #777; }
	td a { color: black; font-weight: 700; }
</style>

<table>
	<tr>
		<th>Thread</th>
		<th>Category</th>
		<th>Posts</th>
		<th>Images</th>
		<th>Last Post</th>
	</tr>
	<?php

		// grab all thread files in order by date
		$threads = glob("threads/*", GLOB_NOSORT);
		array_multisort(array_map('filemtime', $threads), SORT_NUMERIC, SORT_DESC, $threads);

		// display their metadata
		foreach ($threads as $thread) {

			$id = substr($thread, 8);
			$meta_and_posts = explode("<META_DELIMITER>", file_get_contents($thread, false));

			$meta = explode("\n", $meta_and_posts[0]);

			if (!empty($uri[1]) && strcmp($meta[2], $uri[1]) != 0) {
				continue;
			}

			echo "
				<tr>
					<td><a href='/thread/$id'>$meta[0]</a><br>$meta[1]</td>
					<td><a href='/$meta[2]'>$meta[2]</a></td>
					<td>$meta[3]</td>
					<td>$meta[4]</td>
					<td>" . format_date($meta[5]) . "</td>
				</tr>
			";
		}
	?>
</table>