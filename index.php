<!--
	php -S localhost:4444 -t .
	https://www.hostinger.com/

	thread-posts/ (just needs appending to update)
	thread-meta/ (needs to be completely overwritten to update)

	- image uploading
	- update meta when a new post is made under a thread

	and probably a lot of safeguards for if the user tries to like, post to a thread that doesn't exist or something
	and a captcha to prevent botting
	and probably some moderation tools

	ref https://i.redd.it/8zr7f8lm5b3f1.png
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

		textarea { background: black; font: inherit; color: inherit; padding: 0.5em; font-weight: 400; border: none; }

		a, a * { text-decoration: none; color: #844; }
		a:hover, a:hover * { text-decoration: underline; }

		.bigimage { display: none; }
		.smallimage { filter: brightness(50%); }
		a:hover .bigimage { display: block; z-index: 999; position: fixed; height: 90%; top: 50%; right: 2em; transform: translateY(-50%); pointer-events: none; }
	</style>
</head>

<body>
	
	<header>
		<h1>bbwforum - an anonymous forum</h1>
		<nav>
			( <a href="/">All Categories</a> )
			( <a href="/BBW">BBW</a> )
			( <a href="/Hourglass">Hourglass</a> )
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

	<footer id="footer">(c) 2025 dairycultist. All rights reserved.</footer>

</body>

</html>
