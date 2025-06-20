<style>
	td a { font-weight: 700; }
	tr:nth-child(odd) { background: #fdc; }
</style>

<h2>All <?php echo $uri[1]; ?> threads</h2>

<table>
	<tr>
		<th style="width: 55%;">Thread</th>
		<th>Posts</th>
		<th>Images</th>
	</tr>
	<?php

		// grab all thread files in order by date
		$threads = glob("thread-meta/*", GLOB_NOSORT);
		array_multisort(array_map('filemtime', $threads), SORT_NUMERIC, SORT_DESC, $threads);

		// display their metadata
		foreach ($threads as $thread) {

			$id = substr($thread, 12);

			$meta = explode("\n", file_get_contents($thread, false));

			if (!empty($uri[1]) && strcmp($meta[1], $uri[1]) != 0) {
				continue;
			}

			echo "
				<tr>
					<td>
						<div style='font-size: smaller; margin-bottom: 0.5em;'>
							<a href='/$meta[1]'>$meta[1]</a>
							·
							<span style='color: grey;'>Updated " . format_date($meta[4]) . " UTC</span>
						</div>
						<a href='/thread/$id'>$meta[0]</a>
					</td>
					<td>$meta[2]</td>
					<td>$meta[3]</td>
				</tr>
			";
		}
	?>
</table>