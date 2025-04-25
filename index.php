<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>bbwforum - an anonymous forum</title>
	<style>
		body { font-family: sans-serif; }
		table { border-collapse: collapse; }
		th, td { border: 1px solid black; padding: 0.5em 1em; text-align: center; }
		th:first-of-type, td:first-of-type { text-align: left; }
		th { background:rgb(115, 167, 222); }
		td { color: grey; }
	</style>
</head>

<body>

	<!-- php -S localhost:4444 -t . -->

	<table>
		<tr>
			<th>Thread</th>
			<th>Category</th>
			<th>Posts</th>
			<th>Images</th>
			<th>Last Post</th>
		</tr>
		<?php

			$threads = glob("threads/*", GLOB_NOSORT);
			array_multisort(array_map('filemtime', $threads), SORT_NUMERIC, SORT_DESC, $threads);

			foreach ($threads as $thread) {

				$meta_and_posts = explode("<END_META>", file_get_contents($thread, false));

				$meta = explode("\n", $meta_and_posts[0]);

				echo "
					<tr>
						<td><strong><a href>$meta[0]</a></strong><br>$meta[1]</td>
						<td>$meta[2]</td>
						<td>$meta[3]</td>
						<td>$meta[4]</td>
						<td>$meta[5]</td>
					</tr>
				";
			}
		?>
	</table>
</body>

</html>
