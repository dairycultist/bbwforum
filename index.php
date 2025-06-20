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
	ref2 https://www.mumsnet.com/talk/active
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

		body { font-family: "Roboto", sans-serif; background: #f4eeee; color: #222; margin: auto; max-width: 50em; }

		header { background: #844; color: white; align-items: center; padding: 4px; position: sticky; top: 0; display: flex; gap: 2em; }
		header a { color: inherit; }
		h1 { font-weight: 400; }

		footer { background: #844; padding: 1em; color: white; font-size: smaller; margin-top: 8em; }

		table { border-spacing: 0; width: 100%; border: 1px solid #ddd0d0; border-radius: 4px; overflow: hidden; }
		th, td { padding: 0.7em 1em; text-align: center; }
		tr { background: white; }
		th:first-of-type, td:first-of-type { text-align: left; }
		th { background: #fdc; font-weight: 400; }

		textarea { font: inherit; color: inherit; padding: 0.5em; font-weight: 400; border: none; }

		a, a * { text-decoration: none; color: #844; }
		a[href]:hover, a[href]:hover * { text-decoration: underline; }
	</style>
</head>

<body>

	<h1>bbwforum - an anonymous forum</h1>

	<main>
		<?php
		
			if ($uri[1] == "thread") {

				include 'thread.php';

			} else {

				include 'all_threads.php';
			}

		?>
	</main>

	<footer>(c) 2025 dairycultist. All rights reserved.</footer>

</body>

</html>
