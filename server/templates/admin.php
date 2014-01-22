<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Channeltrak Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<div class="container" style="margin-top:40px;">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<form action="http://localhost/channeltrak.com/server/channels">
					<div class="form-group">
						<label for="title">Channel Title</label>
						<input class="form-control" name="title" type="text" />
					</div>
					<div class="form-group">
						<label for="youtube_title">Youtube Title</label>
						<input class="form-control" name="youtube_title" type="text" />
					</div>
					<button class="btn btn-default" type="submit">Create</button>
				</form>
			</div>
		</div>
	</div>

	

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

</body>
</html>