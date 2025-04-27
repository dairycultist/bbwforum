<!DOCTYPE html>
<html>
<head>

	<?php
		function format_date($unix) {
			return date("Y-m-d h:i:sa", $unix);
		}

		$uri = explode("/", $_SERVER["REQUEST_URI"]);

		if ($uri[1] == "thread") {

			$id = $uri[2];

			$meta_and_posts = explode("<META_DELIMITER>", file_get_contents("threads/$id", false));

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
		h1, nav { text-align: center; }
		table { border-collapse: collapse; margin: auto; width: 100%; max-width: 80em; }
		th, td { border: 1px solid black; padding: 0.5em 1em; text-align: center; }
		th:first-of-type, td:first-of-type { text-align: left; }
		th { background:rgb(115, 167, 222); }

		a, a * { text-decoration: none; }
		a:hover, a:hover * { text-decoration: underline; }
	</style>
</head>

<body>

	<!-- php -S localhost:4444 -t . -->
	
	<h1>bbwforum - an anonymous forum</h1>
	<nav>
		[<a href="/">Home</a>]
	</nav>
	<br>

	<?php
	
		if ($uri[1] == "thread") {

			include 'thread.php';

		} else {

			include 'all_threads.php';
		}

	?>
</body>

</html>
