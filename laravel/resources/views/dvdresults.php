<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
	<body>
	  	<div class="container">	
	  	<h1>DVD Search Results</h1>
		<p>You searched for dvds with titles containing: "<?php echo $dvd_title ?>", a rating of <?php echo $rating_name ?>, and in the genre <?php echo $genre_name ?>.</p>
	  	<table class="table">
	  		<thead>
			  <tr>
				<th>Title</th>
				<th>Rating</th>
				<th>Genre</th>
				<th>Label</th>
				<th>Sound</th>
				<th>Format</th>
				<th>Release Date</th>
				<th>More Details</th>
			  </tr>
		  	</thead>
			<tbody>
		  		<?php foreach ($dvds as $dvd) : ?>
			  		<tr>	
					  	<td><?php echo $dvd->title ?></td>
					  	<td><?php echo $dvd->rating_name ?></td>
					   	<td><?php echo $dvd->genre_name ?></td>
					    <td><?php echo $dvd->label_name ?></td>
					    <td><?php echo $dvd->sound_name ?></td>
					    <td><?php echo $dvd->format_name ?></td>
					    <td>
						  <?php 
  						  	$date = strtotime($dvd->release_date);
  							echo date('d-M-Y', $date);
						  ?>
					  	</td>
						<td><a href="/dvds/<?php echo $dvd->id ?>">More Details</a></td>
			  		</tr>
				<?php endforeach ?>
		  	</tbody>
	  	</table>
	  	</div>
	</body>
</html>