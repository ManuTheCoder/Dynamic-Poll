<!DOCTYPE html>
<html>
	<head>
	<?php include("../include/head.html");?>
	</head>
	<body>
		<?php include("../include/nav.html");?>
		<br><br>
		<div class="container">
		<h3><b>Create</b></h3>
		<form action="https://pollapp.ml/add/add.php" method="POST">
			<div class="input-field">
				<label>Poll Title</label>
				<input type="text" name="name" autocomplete="off">
			</div>
			<div class="input-field">
				<label>Options</label>
				<textarea type="text" name="options" autocomplete="off" class="materialize-textarea"></textarea>
			</div>
			<b>Hit enter for each option!</b>
			<br>
			<br>
			<button class="btn blue darken-4 waves-effect waves-light">Submit</button>
		</form>
		</div>
	
		<script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.0.0/dist/js/materialize.min.js" type="text/javascript"></script>
	</body>
</html>