<!DOCTYPE html>
<html>
	<head>
		<title>DVD Search</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="col-md-8">
				<h1>DVD Search</h1>
				<form action="/dvds" method="get">
					Title: <input class="form-control" type="text" name="dvd_title">
					<br>
					Genre: 	
					<select class="form-control" name="genre_id">
							<option value="0">All</option>
						<?php foreach($genres as $genre): ?>
							<option value="<?php echo $genre->id ?>"><?php echo $genre->genre_name ?></option>
						<?php endforeach ?>
					</select>
					<br>
					Ratings:
					<select class="form-control" name="rating_id">
						<option value="0">All</option>
						<?php foreach($ratings as $rating): ?>
							<option value="<?php echo $rating->id ?>"><?php echo $rating->rating_name ?></option>
						<?php endforeach ?>
					</select>
					<br>
					<input class="form-control" style="width: 30%; float: right; margin: 10px 0" type="submit" name="submit" value="Search">
				</form>
			</div>
			<div class="col-md-4">
				<br>
				<h4>Genres</h4>
					<?php foreach($genress as $g) : ?>
						<a href="/genres/<?php echo $g->genre_name ?>/dvds"><?php echo $g->genre_name ?></a><br>
					<?php endforeach ?>
			</div>
		</div>
	</body>
</html>