<!DOCTYPE html>
<html>
<head>
	<?php
		$id = substr($_SERVER["REQUEST_URI"], 15);

		$thread = "threads/$id";

		$meta_and_posts = explode("<END_META>", file_get_contents($thread, false));

		$meta = explode("\n", $meta_and_posts[0]);
		$posts = str_replace("\n", "<br>", $meta_and_posts[1]);
	?>

	<meta charset="UTF-8">
	<title>bbwforum - <?php echo $meta[0]; ?></title>
	<link rel="stylesheet" href="shared.css">
</head>

<body>

	<!-- php -S localhost:4444 -t . -->

	<?php

		echo $posts;
	?>
</body>

</html>
