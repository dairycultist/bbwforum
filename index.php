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

			// glob

			echo str_replace("\n", "<br>", file_get_contents("thread", false));

			echo "
				<tr>
					<td><strong><a href>Fat Foxgirls</a></strong><br>basically any foxgirls from anime that are big and chonky. I wanted to see senko so</td>
					<td>BBW</td>
					<td>31</td>
					<td>17</td>
					<td>Wed Oct 21, 2009 12:09 pm</td>
				</tr>
			";

		?>
	</table>
</body>

</html>
