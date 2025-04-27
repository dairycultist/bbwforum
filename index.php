<!DOCTYPE html>
<html>
<head>

	<?php
		$uri = explode("/", $_SERVER["REQUEST_URI"]);

		if ($uri[1] == "thread") {

			$id = $uri[2];

			$thread = "threads/$id";

			$meta_and_posts = explode("<META_DELIMITER>", file_get_contents($thread, false));

			$meta = explode("\n", $meta_and_posts[0]);
			$posts = explode("<POST_DELIMITER>", $meta_and_posts[1]);
		}
	?>

	<meta charset="UTF-8">
	<title>
		bbwforum
		<?php if ($uri[1] == "thread") { echo "- $meta[0]"; } ?>
	</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

		body { font-family: "Roboto", sans-serif; }
		table { border-collapse: collapse; }
		th, td { border: 1px solid black; padding: 0.5em 1em; text-align: center; }
		th:first-of-type, td:first-of-type { text-align: left; }
		th { background:rgb(115, 167, 222); }
		td { color: #777; }
		td a { color: black; font-weight: 700; text-decoration: none; }
		td a:hover { text-decoration: underline; }
		td p { color: black; }
		td blockquote { color: green; margin: 1em 0; }
	</style>
</head>

<body>

	<!-- php -S localhost:4444 -t . -->
	
	<h1>bbwforum - an anonymous forum</h1>

	<?php
	
		if ($uri[1] == "thread") {

			include 'thread.php';

		} else {

			include 'all_threads.php';
		}

	?>
</body>

</html>
