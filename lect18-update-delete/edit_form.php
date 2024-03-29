<?php

// Include the config.php with constants here
require "config/config.php"; 

// Check that the track_id has been passed to this page
if( !isset($_GET["track_id"]) || empty($_GET["track_id"]) ) {
	echo "Invalid Track";
	exit();
}

// DB Connection.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

// Genres:
$sql_genres = "SELECT * FROM genres;";
$results_genres = $mysqli->query($sql_genres);
if ( $results_genres == false ) {
	echo $mysqli->error;
	exit();
}

// Media Types:
$sql_media_types = "SELECT * FROM media_types;";
$results_media_types = $mysqli->query($sql_media_types);
if ( $results_media_types == false ) {
	echo $mysqli->error;
	exit();
}

// Albums:
$sql_albums = "SELECT * FROM albums;";
$results_albums = $mysqli->query($sql_albums);
if ( $results_albums == false ) {
	echo $mysqli->error;
	exit();
}

// Get details of this track
$sql_track = "SELECT * FROM tracks 
WHERE track_id = " . $_GET["track_id"] . ";";

$results_track = $mysqli->query($sql_track);
if( !$results_track ) {
	echo $mysqli->error;
	exit();
}

// We'll get ONE track back 
$row_track = $results_track->fetch_assoc();
var_dump($row_track);


// Close DB Connection
$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Form | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php">Details</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="edit_confirmation.php" method="POST">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">
					Track Name: <span class="text-danger">*</span>
				</label>
<div class="col-sm-9">
	<!-- Pre-filling the text field with the track name -->
	<input type="text" class="form-control" id="name-id" name="track_name" value="<?php echo $row_track['name']?>">
</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">
					Genre: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">

<!-- Pre-select the genre of this track -->
<select name="genre" id="genre-id" class="form-control">
	<option value="" disabled>-- Select One --</option>

	<?php while( $row = $results_genres->fetch_assoc() ): ?>

		<?php if( $row["genre_id"] == $row_track["genre_id"]) : ?>
			<!-- Add 'selected' attribute to the genre of this track. This will make this option show up first. -->
			<option selected value="<?php echo $row['genre_id']; ?>">
				<?php echo $row['name']; ?>
			</option>

		<?php else : ?>
			<!-- All other dropdown options are still shown, but does not have the 'selected' attribute -->
			<option value="<?php echo $row['genre_id']; ?>">
				<?php echo $row['name']; ?>
			</option>

		<?php endif; ?>

	<?php endwhile; ?>

</select>

				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="composer-id" class="col-sm-3 col-form-label text-sm-right">
					Composer:
				</label>
				<div class="col-sm-9">
<!-- Pre-fill this track's composer -->
<input type="text" name="composer" id="composer-id" class="form-control" value="<?php echo $row_track['composer']?>">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> <!-- .form-group -->

<!-- Pass the track_id to edit_confirmation.php by creating a HIDDEN input -->
		<input type="hidden" name="track_id" value="<?php echo $row_track['track_id']; ?>"/>

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>