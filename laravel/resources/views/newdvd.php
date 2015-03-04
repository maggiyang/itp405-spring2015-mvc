<!DOCTYPE html>
<html>
	<head>
		<title>Add Dvd</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<h1>Add Dvd</h1>
			<?php if(Session::has('success')) :?>
			<h5 style="background-color: green; color: #fff"><?php echo Session::get('success') ?></h5>
			<?php endif ?>
			<?php foreach($errors->all() as $errorMessage): ?>
				<h5 style="color: red"><?php echo $errorMessage ?></h5>
			<?php endforeach  ?>
			<form method="post" action="/dvds/">
				<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"> 
				Title: <input type="text" class="form-control" name="title" value="<?php echo Request::old('title') ?>">
				Label: <select class="form-control" name="label">
					<?php foreach($labels as $label) : ?>
						<?php if($label == Request::old('label')) :?>
							<option value="<?php echo $label->id ?>" selected="selected"><?php echo $label->label_name ?></option>
						<?php else : ?>
							<option value="<?php echo $label->id ?>"><?php echo $label->label_name ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
				Sound: <select class="form-control" name="sound">
					<?php foreach($sounds as $sound) : ?>
						<?php if($sounds == Request::old('sound')) :?>
							<option value="<?php echo $sound->id ?>" selected="selected"><?php echo $sound->sound_name ?>
						<?php else : ?>
							<option value="<?php echo $sound->id ?>"><?php echo $sound->sound_name ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
				Genre: <select class="form-control" name="genre">
					<?php foreach($genres as $g) : ?>
					<option value="<?php echo $g->id ?>"><?php echo $g->genre_name ?></option>
					<?php endforeach ?>
				</select>
				Rating: <select class="form-control" name="rating">
					<?php foreach($ratings as $r) : ?>
					<option value="<?php echo $r->id ?>"><?php echo $r->rating_name ?></option>
					<?php endforeach ?>
				</select>
				Format: <select class="form-control" name="format">
					<?php foreach($formats as $f) : ?>
					<option value="<?php echo $f->id ?>"><?php echo $f->format_name ?></option>
					<?php endforeach ?>
				</select>
				<input type="submit" class="btn btn-default" value="Add Dvd">
			</form>
		</div>
	</body>
</html>