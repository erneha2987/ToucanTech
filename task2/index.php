<!DOCTYPE html>
<html>
<head>
	<title>Search Users</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
</head>
<body>
	<div class="container mt-5">
		<h1 class="text-center mb-4">Search Users</h1>
		<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Name:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="name" name="name">
			</div>
			<div class="col-sm-2">
				<button id="search-btn" class="btn btn-primary">Search</button>
			</div>
		</div>
		<div id="results"></div>
	</div>

</body>
</html>
