<style>
	td a { font-weight: 700; }
	tr:nth-child(even) { background: #fdc; }

	nav { display: flex; }
	nav a { padding: 1em; }
	nav a.selected { border-bottom: 4px solid #844; padding-bottom: calc(1em - 4px); cursor: default; }
</style>

<table>
	<tr>
		<td colspan="3" style="padding: 0;">
			<nav>
				<a <?php if (strcmp($uri[1], "") == 0) { echo "class='selected'"; } else { echo "href='/'"; } ?>>
					All Categories
				</a>
				<a <?php if (strcmp($uri[1], "BBW") == 0) { echo "class='selected'"; } else { echo "href='/BBW'"; } ?>>
					BBW
				</a>
				<a <?php if (strcmp($uri[1], "Hourglass") == 0) { echo "class='selected'"; } else { echo "href='/Hourglass'"; } ?>>
					Hourglass
				</a>
			</nav>
		</td>
	</tr>
	<tr style="background: transparent;">
		<td style="width: 55%;">Thread</td>
		<td>Posts</td>
		<td>Images</td>
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