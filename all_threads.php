<style>
	td a { font-weight: 700; }
	tr:nth-child(odd) { background: #fdc; }
</style>

<h2>All <?php echo $uri[1]; ?> threads</h2>

<table>
	<tr>
		<th style="width: 55%;">Thread</th>
		<th>Category</th>
		<th>Posts</th>
		<th>Images</th>
		<th>Last Post</th>
	</tr>
	<?php

		// grab all thread files in order by date
		$threads = glob("thread-meta/*", GLOB_NOSORT);
		array_multisort(array_map('filemtime', $threads), SORT_NUMERIC, SORT_DESC, $threads);

		// display their metadata
		foreach ($threads as $thread) {

			$id = substr($thread, 12);

			$meta = explode("\n", file_get_contents($thread, false));

			if (!empty($uri[1]) && strcmp($meta[2], $uri[1]) != 0) {
				continue;
			}

			echo "
				<tr>
					<td><a href='/$meta[1]' style='font-size: smaller;'>$meta[1]</a> ·<br><a href='/thread/$id'>$meta[0]</a></td>
					<td>$meta[2]</td>
					<td>$meta[3]</td>
					<td>" . format_date($meta[4]) . " UTC</td>
				</tr>
			";
		}
	?>
</table>