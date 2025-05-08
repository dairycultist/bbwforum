<!DOCTYPE html>
<html>
<head>
	<script>

		<?php
			$post_body = strip_tags($_POST["post_body"]);

			// https://stackoverflow.com/questions/709669/how-do-i-remove-blank-lines-from-text-in-php
			$post_body = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $post_body);

			if (!empty(trim($post_body))) {

				$result = file_put_contents(
					"thread-posts/" . $_POST["post_id"],
					"\n<POST_DELIMITER>\n" . time() . "\n<POST_PART>\n<POST_PART>\n" . $post_body,
					FILE_APPEND | LOCK_EX
				);

				// just make an alert if something fails
				if ($result === false) {
					echo "alert('Something went wrong on our end.');";
				}

			} else {
				echo "alert('Post cannot be empty.');";
			}
		?>

		window.location.replace("/thread/<?php echo $_POST["post_id"]; ?>#footer");

	</script>
</head>
</html>
