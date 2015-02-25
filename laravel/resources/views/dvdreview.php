<!DOCTYPE html>
<html>
	<head>
		<title>DVD Review</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
		<h1> <?php echo $dvd->title ?> Reviews</h1>
		<div class="col-md-4">
			<h5>Title:</h5> <?php echo $dvd->title ?>
			<h5>Rating:</h5> <?php echo $dvd->rating_name?>
			<h5>Genre:</h5> <?php echo $dvd->genre_name ?>
			<h5>Label:</h5> <?php echo $dvd->label_name ?>
			<h5>Sound: </h5> <?php echo $dvd->sound_name ?>
			<h5>Format: </h5> <?php echo $dvd->format_name ?>
			<h5>Release Date:</h5> <?php $date = strtotime($dvd->release_date); echo date('d-M-Y', $date); ?>
			<br><br>
			<h5><a href="/dvds">Back to DVDs</a></h5>
		</div>
			
		<div class="col-md-8">
			<?php if(Session::has('success')) :?>
			<h5 style="color: green"><?php echo Session::get('success') ?></h5>
			<?php endif ?>
			<?php foreach($errors->all() as $errorMessage): ?>
				<h5 style="color: red"><?php echo $errorMessage ?></h5>
			<?php endforeach  ?>
			<h4>Add Review</h4>
			<form action="/dvds/addreview" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"> 
			<input type="hidden" name="review_dvdid" value="<?php echo $dvd_id ?>"> 
			Review Title: <input class="form-control" type="text" name="review_title" value="
<?php echo Request::old('review_title') ?>">
			Rating: 
				<select class="form-control" name="review_rating">
					<?php for($i=1; $i<=10; $i++){?>
					<?php if($i == Request::old('review_rating')) : ?> 
						<option value="<?php echo $i ?>" selected="selected"><?php echo $i ?></option>
					<?php else : ?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					<?php endif ?>
					<?php } ?> 
				</select>
			Description: <textarea class="form-control" name="review_description" rows="3"><?php echo Request::old('review_description')?></textarea>
			<input class="btn btn-default" type="submit" name="review_submit" value="Add Review"> 
			</form>
			<br><br>
			<h4>Reviews </h4>
<!--			<table class="table">-->
			<?php foreach ($reviews as $review) :?>
				<div class="reviews" style="width:90%; height: auto; padding: 5px; margin: 5px 0; overflow: auto;">
				<h5><?php echo $review->title ?></h5>
				<p><?php echo $review->description ?></p>
				<p>Rating: <?php echo $review->rating ?></p>
				</div>
			<?php endforeach ?>
<!--			</table>-->
		</div>
		</div>
	</body>
</html>