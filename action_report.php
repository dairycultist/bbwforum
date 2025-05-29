<!DOCTYPE html>
<html>
<head>
	<script>

		const params = new URLSearchParams(window.location.search);

		alert("report: " + params.get('thread') + " " + params.get('post'));

		window.location.replace(`/thread/${ params.get('thread') }#${ params.get('post') }`);

	</script>
</head>
</html>
