<!--
	php -S localhost:4444 -t .
	https://www.hostinger.com/

	- split "threads/" into "thread-posts/" and "thread-meta/" (since former just needs appending, but latter needs to be completely overwritten sometimes)
	- image uploading
	- update meta when a new post is made under a thread

	and probably a lot of safeguards for if the user tries to like, post to a thread that doesn't exist or something
	and a captcha to prevent botting
	and probably some moderation tools
-->

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

			$meta = explode("\n", file_get_contents("thread-meta/$id", false));
			$posts = explode("<POST_DELIMITER>", file_get_contents("thread-posts/$id", false));
		}
	?>

	<meta charset="UTF-8">
	<title>
		bbwforum
		<?php if ($uri[1] == "thread") { echo "- $meta[0]"; } ?>
	</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

		body { font-family: "Roboto", sans-serif; background: black; color: #bbb; margin: 0 1em; }
		header, footer { text-align: center; margin: 8em 0; }
		table { border-collapse: collapse; width: 100%; }
		th, td { border: 1px solid #422; padding: 0.5em 1em; text-align: center; }
		th:first-of-type, td:first-of-type { text-align: left; }
		th { background: #422; }

		a, a * { text-decoration: none; color: #844; }
		a:hover, a:hover * { text-decoration: underline; }
	</style>
</head>

<body>
	
	<header>
		<h1>bbwforum - an anonymous forum</h1>
		<nav>
			[ <a href="/">All Categories</a> ]
			[ <a href="/BBW">BBW</a> ]
			[ <a href="/Hourglass">Hourglass</a> ]
		</nav>
	</header>

	<div style="display: flex; gap: 1em;">
		<main style="flex: 1;">
			<?php
			
				if ($uri[1] == "thread") {

					include 'thread.php';

				} else {

					include 'all_threads.php';
				}

			?>
		</main>
		<aside style="width: 20em;">

		</aside>
	</div>

	<footer>(c) 2025 dairycultist. All rights reserved.</footer>

</body>

</html>
