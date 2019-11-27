<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];
	// json_encode() converts associative arrays to a STRING that is in JSON format
	// echo json_encode($php_array);
	// echo "hello frontend!";
	// echo "hello frontend!";
	// echo "hello frontend!";
	// echo "hello frontend!";
	// echo "hello frontend!";
	// var_dump("hello. dump");

	// backend can grab any values passed using the $_GET or $_POST super global
	// $_GET["firstName"];
	// $_POST["firstName"];


	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Grab what the user searched for 
	$searchTerm = $_GET["term"];

	// SQL Statement to search for whatever the user entered
	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $searchTerm . "%' LIMIT 10;";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

	// Create an empty array. Will fill all the results in this array.
	$results_array = [];

	while( $row = $results->fetch_assoc() ) {
		array_push($results_array, $row);
	}

	// Convert this one array to a STRING in JSON format
	echo json_encode($results_array);




?>



