<!DOCTYPE html>
<html>
<head>
	<script>
		<?php

		// just make an alert if something fails

		$result = file_put_contents(
			"threads/" . $_POST["post_id"],
			"\n<POST_DELIMITER>\nWed Oct 21, 2009 12:10 pm\n<POST_PART>\n<POST_PART>\n" . $_POST["post_body"],
			FILE_APPEND | LOCK_EX
		);

		if ($result === false) {
			echo "alert('error');";
		}

		?>

		window.location.replace("/thread/<?php echo $_POST["post_id"]; ?>");
	</script>
</head>
</html>
